<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Topic;
use App\TopicUser;
use App\Usercontact;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    //VIEWS

    public function index()
    {
        return view('user');
    }

    //BACK REQUESTS

    public function auth()
    {

        try {

            $user = Auth::user();
            return response()->json($user);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }


    //FRONT REQUESTS

    public function user($idUser)
    {

        try {
            $user = User::find($idUser);

            return response()->json($user);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }

    public function updateUser(Request $request)
    {

        try {
            User::where('id', $request->id)->update(['login' => $request->login, 'name' => $request->name,
                'email' => $request->email, 'idtype' => $request->idtype]);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }


    public function createUser(Request $request)
    {

        try {

            if (!User::where('email', $request->email)->count() > 0) {

                $user = New User();
                $user->login = $request->login;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->idtype = $request->idtype;
                $user->save();

                $newUser = User::find($user->id);

                $token = JWTAuth::fromUser($newUser);

                $newUser->remember_token = $token;
                $newUser->save();

                return response()->json(compact('token'));
            }

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }


    }

    public function connectUser(Request $request)
    {

        try {

            $credentials = Input::only('email', 'password');

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(false);
            }
            $user = User::where('email', $request->email)->get()[0];
            $user->remember_token = $token;
            $user->save();
            return response()->json(compact('token'));

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }

    public function getAuthor($idAuthor)
    {

        try {

            $user = User::where('id', $idAuthor)->get();
            return response()->json($user);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }

    }

    public function getNumberOfContacts($idAuthor)
    {

        try {

            $nbContacts = Usercontact::where('user1', $idAuthor)->orWhere('user2', $idAuthor)->count();
            return response()->json($nbContacts);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }

    }

    public function getMutualContacts($idUser, $idAuthor)
    {

        try {

            $idContacts1User = Usercontact::select('user1')->where('user2', $idUser)->where('valid', true)->get();
            $idContacts2User = Usercontact::select('user2')->where('user1', $idUser)->where('valid', true)->get();

            $idContacts1OtherUser = Usercontact::select('user1')->where('user2', $idAuthor)->where('valid', true)->get();
            $idContacts2OtherUser = Usercontact::select('user2')->where('user1', $idAuthor)->where('valid', true)->get();


            $idContactsUser = collect([]);

            foreach ($idContacts1User as $idContact) {
                if ($idContact->user1 != $idUser) {
                    $idContactsUser->push($idContact->user1);
                }
            }

            foreach ($idContacts2User as $idContact) {
                if ($idContact->user2 != $idUser) {
                    $idContactsUser->push($idContact->user2);
                }
            }

            $idContactsOtherUser = collect([]);

            foreach ($idContacts1OtherUser as $idContact) {
                if ($idContact->user1 != $idAuthor) {
                    $idContactsOtherUser->push($idContact->user1);
                }
            }

            foreach ($idContacts2OtherUser as $idContact) {
                if ($idContact->user2 != $idAuthor) {
                    $idContactsOtherUser->push($idContact->user2);
                }
            }

            $nbMutualContacts = 0;


            foreach ($idContactsUser as $idContactUser) {
                foreach ($idContactsOtherUser as $idContactOtherUser) {
                    if ($idContactUser == $idContactOtherUser) {
                        $nbMutualContacts++;
                    }
                }
            }

            return response()->json($nbMutualContacts);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }

    }

    public function getMutualTopics($idUser, $idAuthor)
    {

        try {

            $idTopicsUser = TopicUser::select('idTopic')->where('idUser', $idUser)->get();
            $idTopicsOtherUser = TopicUser::select('idTopic')->where('idUser', $idAuthor)->get();

            $nbMutualTopics = 0;


            foreach ($idTopicsUser as $idTopicUser) {

                foreach ($idTopicsOtherUser as $idTopicOtherUser) {
                    if ($idTopicUser->idTopic == $idTopicOtherUser->idTopic) {
                        $nbMutualTopics++;
                    }
                }
            }

            return response()->json($nbMutualTopics);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }

    }


    public function logout(Request $request)
    {

        try {
            $user = User::find($request->id);
            $access_token = $user->remember_token;
            $user->remember_token = '';
            $user->save();


            return response()->json($access_token);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }

}
