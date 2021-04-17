<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        return view('list', [
            'posts' => Profile::get(),
        ]);
    }

    public function store(ProfileRequest $request)
    {
        $profile = Profile::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'country' => $request->country
        ]);

        return response()->json([
            'message' => 'User baru berhasil ditambahkan',
            'data' => $profile
        ], 200);
        // return redirect(
        //     route('post.show')
        // );
    }

    public function show(Profile $profile)
    {
        return new ProfileResource($profile);
    }

    public function edit($id)
    {
        $profile = Profile::find($id);
        // return view('edit', [
        //     'profile' => $profile
        // ]);
        return response()->json([
            'data' => $profile
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::find($id);

        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'first_name' => 'required'
        ]);

        $profile->update([
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'country' => $request->country
        ]);

        return response()->json([
            'message' => 'Data berhasil di update',
            'data_baru' => $profile,
        ], 200);
    }

    public function delete($id)
    {
        $profile = Profile::find($id);
        $profile->delete();

        return response()->json([
            'message' => 'Data berhasil di hapus',
        ], 200);
    }

    public function showAll()
    {
        $profile = Profile::get();
        $collection = ProfileResource::collection($profile);

        return response()->json([
            'data' => $collection
        ], 200);
    }

    public function findOne($id)
    {
        $profile = Profile::find($id);

        return response()->json([
            'data' => $profile
        ], 200);
    }

    public function bulkInsert(Request $request)
    {
        foreach ($request->list_users as $value) {
            $profile = array(
                'username' => $value['username'],
                'email' => $value['email'],
                'password' => Hash::make($value['password']),
                'first_name' => $value['first_name'],
                'last_name' => $value['last_name'],
                'address' => $value['address'],
                'city' => $value['city'],
                'province' => $value['province'],
                'country' => $value['country']
            );

            $profiles = Profile::create($profile);
        }

        return response()->json([
            'message' => 'Semua data berhasil dimasukkan ke database'
        ], 200);
    }

    public function bulkUpdate(Request $request, $id)
    {
        $postIds = explode(",", $id);
        $posts = Profile::whereIn('id', $postIds)->get()->toArray();

        // foreach ($request->list_users as $value) {
        //     $profile = array(
        //         'username' => $value['username'],
        //         'email' => $value['email'],
        //         'first_name' => $value['first_name'],
        //         'last_name' => $value['last_name'],
        //         'address' => $value['address'],
        //         'city' => $value['city'],
        //         'province' => $value['province'],
        //         'country' => $value['country']
        //     );

        //     $posts->update($profile);
        // }

        // return response()->json([
        //     'message' => 'Semua data berhasil dimasukkan ke database'
        // ], 200);
    }
}
