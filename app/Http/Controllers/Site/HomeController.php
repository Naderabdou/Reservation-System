<?php

namespace App\Http\Controllers\Site;



use App\Models\User;

use App\Models\Service;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

use Filament\Notifications\Events\DatabaseNotificationsSent;

class HomeController extends Controller
{
    public function index()
    {



        $services = Service::where('is_available', 1)->latest()->take(6)->get();


        return view('site.home', compact('services'));
    }




    public function contact_request(ContactUsRequest $request)
    {

        $contact = Contact::create($request->validated());


        Notification::make()
            ->title('يريد العميل ' . $request->name . ' التواصل معك')
            ->actions([
                Action::make('view')
                    ->label('عرض الرسالة')
                    ->button()
                    ->url(function () use ($contact) {
                        return route('filament.admin.resources.contacts.view', $contact->id);
                    })
                    ->markAsRead()

            ])
            // ->broadcast(User::role('admin')->first());
            ->sendToDatabase(User::role('admin')->first());

        event(new DatabaseNotificationsSent(User::role('admin')->first()));


        return response()->json(['success' => __('تم ارسال الرسالة بنجاح وسوف يتم الرد عليك في اقرب وقت')]);
    }




    public function lang($lang)
    {

        session()->put('lang', $lang);
        return redirect()->back();
    }
}
