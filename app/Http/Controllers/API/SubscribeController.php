<?php

namespace App\Http\Controllers\API;

use DrewM\MailChimp\MailChimp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Spatie\Newsletter\Newsletter;
use Spatie\Newsletter\NewsletterListCollection;

class SubscribeController extends Controller
{
    /**
     * Subscribe user to the MailChimp list.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'api_key' => 'required',
            'list_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response('', 406);
        }
        $data = $validator->getData();
        $mailchimp = new MailChimp($data['api_key']);

        // Create ListCollection manually.
        $lists = NewsletterListCollection::createFromConfig(
            [
                'lists' => [
                    'defaultList' => [
                        'id' => $data['list_id']
                    ]
                ],
                'defaultListName' => 'defaultList'
            ]
        );
        $newsletter = new Newsletter($mailchimp, $lists);

        // Subscribe the user via email.
        $subscriber = $newsletter->subscribe($data['email']);
        if ($subscriber && is_array($subscriber) && isset($subscriber['id'])) {
            return response()->json(['id' => $subscriber['id']]);
        }
        return response('', 404);
    }
}
