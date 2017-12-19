<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Topic;
use App\TopicUser;
use App\Message;
use App\User;
use Illuminate\Http\Request;


class TopicController extends Controller
{

    //VIEWS

    public function index()
    {

        return view('topic');
    }

    //BACK REQUESTS

    public function show()
    {

        try {

            $idTopics = TopicUser::select('idTopic')->where('idUser', Auth::id())->get();

            $topics = Topic::whereIn('id', $idTopics)->get();

            return response()->json($topics);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }


    }

    public function create(Request $request)
    {

        try {
            $topic = new Topic();
            $topic->nom = $request->nom;
            $topic->idAdmin = Auth::id();
            $topic->save();

            $topicuser = new TopicUser();
            $topicuser->idTopic = $topic->id;
            $topicuser->idUser = Auth::id();
            $topicuser->save();

            return response()->json($topic);
        } catch (\Exception $e) {
            return response()->json(array('error' => 'an error has occured'));
        }

    }

    public function createTopic(Request $request, $idUser)
    {

        try {

            $topic = new Topic();
            $topic->nom = $request->name;
            $topic->idAdmin = $idUser;
            $topic->save();

            $topicuser = new TopicUser();
            $topicuser->idTopic = $topic->id;
            $topicuser->idUser = $idUser;
            $topicuser->save();

            return response()->json($topic);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }

    }

    public function leaveTopic($idTopic)
    {

        try {

            TopicUser::where('idTopic', $idTopic)->where('idUser', Auth::id())->delete();
        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }

    // API REQUESTS

    public function leaveFrontTopic($idUser, $idTopic)
    {
        try {
            TopicUser::where('idTopic', $idTopic)->where('idUser', $idUser)->delete();
        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }

    public function getTopic($idTopic)
    {

        try {

            $topic = Topic::where('id', $idTopic)->get();
            return response()->json($topic);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }

    }

    public function deleteUserFromTopic(Request $request)
    {

        try {

            $topic = Topic::where('id', $request->idTopic)->get();

            if ($topic[0]->idAdmin == $request->idUserConnected) {

                TopicUser::where('idTopic', $request->idTopic)->where('idUser', $request->idUser)->delete();
                $user = User::where('id', $request->idUser)->get();
                return response()->json($user);
            }
            return 'denied';

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }


    public function topicsUser($idUser)
    {
        try {

            $idTopics = TopicUser::select('idTopic')->where('idUser', $idUser)->get();

            $topics = Topic::whereIn('id', $idTopics)->get();

            return response()->json($topics);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }


    public function topicMessages($idTopic)
    {

        try {

            $messages = Message::join('users', 'messages.idAuthor', '=', 'users.id')
                ->where('idTopic', $idTopic)->get();
            return response()->json($messages);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }

    public function deleteTopic($idUser, $idTopic)
    {

        try {

            TopicUser::where('idTopic', $idTopic)->where('idUser', $idUser)->delete();

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }


    public function isUserTopicMember(Request $request)
    {
        $num = TopicUser::where('idTopic', $request->idTopic)->where('idUser', $request->idUser)->count();
        return $num;
    }

    public function renameTopic(Request $request)
    {
        try {

            $topic = Topic::where('id', $request->idTopic)->get();

            if ($topic[0]->idAdmin == $request->idUser) {
                $topic = $topic[0];
                $topic->nom = $request->name;
                $topic->save();
            }

            return response()->json($topic);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }

    public function deleteUser($idTopic, $idUser)
    {

        try {

            TopicUser::where('idTopic', $idTopic)->where('idUser', $idUser)->delete();

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }

    public function deleteMember($idTopic, $idUser)
    {

        try {

            TopicUser::where('idTopic', $idTopic)->where('idUser', $idUser)->delete();

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }

    public function usersTopic($idTopic)
    {

        try {

            $idUsers = TopicUser::select('idUser')->where('idTopic', $idTopic)->get();

            $users = User::whereIn('id', $idUsers)->get();

            return response()->json($users);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }

    public function removeTopic(Request $request)
    {
        try {

            $topic = Topic::where('id', $request->idTopic)->get();

            if ($topic[0]->idAdmin == $request->idUser) {
                TopicUser::where('idTopic', $request->idTopic)->delete();
                Message::where('idTopic', $request->idTopic)->delete();
                Topic::where('id', $request->idTopic)->delete();
            }

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }

    public function addContacts(Request $request)
    {
        try {

            $topic = Topic::where('id', $request->idTopic)->get();

            if ($topic[0]->idAdmin == $request->idUserConnected) {
                $topicuser = new TopicUser();
                $topicuser->idTopic = $request->idTopic;
                $topicuser->idUser = $request->idUser;
                $topicuser->save();
                return $topicuser;
            }
            return 'denied';

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }
}
