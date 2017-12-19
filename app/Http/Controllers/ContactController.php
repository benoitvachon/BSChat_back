<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Usercontact;
use App\User;
use App\Topic;
use Illuminate\Http\Request;


class ContactController extends Controller
{

    //VIEWS

    public function index()
    {
        return view('contact');
    }

    //BACK REQUESTS

    public function show()
    {

        try {

            $idcontacts1 = Usercontact::select('user1')->where('user2', Auth::id())->get();
            $idcontacts2 = Usercontact::select('user2')->where('user1', Auth::id())->get();

            $contacts1 = User::whereIn('id', $idcontacts1)->get();
            $contacts2 = User::whereIn('id', $idcontacts2)->get();

            $contacts = collect([]);

            foreach ($contacts1 as $contact) {
                if ($contact->id != Auth::id()) {
                    $contacts->push($contact);
                }
            }

            foreach ($contacts2 as $contact) {
                if ($contact->id != Auth::id()) {
                    $contacts->push($contact);
                }
            }

            return response()->json($contacts);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }

    public function addContact(Request $request)
    {

        try {

            $topic = new Topic();
            $topic->nom = $request->nom;
            $topic->idAdmin = Auth::id();
            $topic->save();

            $usercontact = new Usercontact();
            $usercontact->user1 = Auth::id();
            $usercontact->user2 = $request->idContact;
            $usercontact->idTopic = $topic->id;
            $usercontact->save();

            $contact = User::where('id', $request->idContact)->get();
            return response()->json($contact);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }

    }

    public function getTopic($idContact)
    {

        try {

            $idTopic = Usercontact::select('idTopic')->where([['user1', '=', Auth::id()],
                ['user2', '=', $idContact]])
                ->orWhere([['user1', '=', $idContact],
                    ['user2', '=', Auth::id()]])->get();

            $idTopic = $idTopic[0]->idTopic;

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

    //API REQUESTS

    public function getContact($idContact)
    {

        try {

            $contact = User::where('id', $idContact)->get();
            return response()->json($contact);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }

    }

    public function deleteContact($idUser, $idContact)
    {

        try {

            $idTopic = Usercontact::select('idTopic')->where([['user1', '=', $idUser],
                ['user2', '=', $idContact]])
                ->orWhere([['user1', '=', $idContact],
                    ['user2', '=', $idUser]])->get();

            $idTopic = $idTopic[0]->idTopic;

            Usercontact::where([['user1', '=', $idUser],
                ['user2', '=', $idContact]])
                ->orWhere([['user1', '=', $idContact],
                    ['user2', '=', $idUser]])->delete();

            Message::where('idTopic', $idTopic)->delete();

            Topic::where('id', $idTopic)->delete();

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }
    }

    public function contactsUser($idUser)
    {

        try {

            $idcontacts1 = Usercontact::select('user1')->where('user2', $idUser)->where('valid', true)->get();
            $idcontacts2 = Usercontact::select('user2')->where('user1', $idUser)->where('valid', true)->get();

            $contacts1 = User::whereIn('id', $idcontacts1)->get();
            $contacts2 = User::whereIn('id', $idcontacts2)->get();

            $contacts = collect([]);

            foreach ($contacts1 as $contact) {
                if ($contact->id != $idUser) {
                    $contacts->push($contact);
                }
            }

            foreach ($contacts2 as $contact) {
                if ($contact->id != $idUser) {
                    $contacts->push($contact);
                }
            }

            return response()->json($contacts);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }

    }

    public function getFrontTopic($idUser, $idContact)
    {

        try {

            $idTopic = Usercontact::select('idTopic')->where([['user1', '=', $idUser],
                ['user2', '=', $idContact]])
                ->orWhere([['user1', '=', $idContact],
                    ['user2', '=', $idUser]])->get();

            $idTopic = $idTopic[0]->idTopic;

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

    public function sendContactRequest(Request $request, $idUser)
    {

        try {

            $contact = User::where('email', $request->email)->get();

            if ($contact->isEmpty()) {
                return response()->json('invalid');
            }

            if($contact[0]->id == $idUser) {
                return response()->json('yourself');
            }

            $usercontact = Usercontact::where([['user1', '=', $idUser],
                ['user2', '=', $contact[0]->id]])
                ->orWhere([['user1', '=', $contact[0]->id],
                    ['user2', '=', $idUser]])->get();

            if (!$usercontact->isEmpty()) {
                if (!$usercontact[0]->valid) {
                    return response()->json('requested');

                }
                return response()->json('exists');
            }

            $topic = new Topic();
            $topic->nom = 'Contact';
            $topic->idAdmin = $idUser;
            $topic->save();


            $usercontact = new Usercontact();
            $usercontact->user1 = $idUser;
            $usercontact->user2 = $contact[0]->id;
            $usercontact->idTopic = $topic->id;
            $usercontact->valid = false;
            $usercontact->save();

            return response()->json($contact);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }

    }

    public function getFriendRequests($idUser)
    {

        try {

            $idcontacts = Usercontact::select('user1')->where('user2', $idUser)->where('valid', false)->get();
            $contacts = User::whereIn('id', $idcontacts)->get();

            return response()->json($contacts);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }

    }

    public function acceptRequest($idUser, $idRequest)
    {

        try {

            $usercontact = Usercontact::where('user1', $idRequest)->where('user2', $idUser)->get();
            $usercontact[0]->valid = true;
            $usercontact[0]->save();

            $user = User::where('id', $idRequest)->get();

            return response()->json($user);

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }

    }

    public function refuseRequest($idUser, $idRequest)
    {

        try {

            $usercontact = Usercontact::where('user1', $idRequest)->where('user2', $idUser)->get();

            $usercontact[0]->delete();

            Topic::where('id', $usercontact[0]->idTopic)->delete();

        } catch (\Exception $e) {
            $content = array(
                'code' => 500,
                'error' => 'An error has occured'
            );
            return response()->json($content, 500);
        }


    }


}
