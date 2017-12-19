<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use \DateTime;
use App\TopicUser;
use App\Usercontact;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        try {

            $topicUserExists = TopicUser::where('idTopic', $request->idTopic)->where('idUser', $request->idAuthor)->count();
            $userContactExists = Usercontact::where('idTopic', $request->idTopic)->where('user1', $request->idAuthor)->orWhere('user2', $request->idAuthor)->count();

            if ($topicUserExists > 0 || $userContactExists > 0) {
                $message = new Message();
                $message->text = $request->text;
                $message->idAuthor = $request->idAuthor;
                $message->idTopic = $request->idTopic;
                $message->save();

                $messageWithInfos = Message::join('users', 'messages.idAuthor', '=', 'users.id')->find($message->id);
                $messageWithInfos->id = $message->id;

                return response()->json($messageWithInfos);
            }
            return response()->json($userContactExists);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }

    }
}
