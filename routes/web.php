<?php


use Illuminate\Support\Facades\Route;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/t', function () {
    /**
     * @var $bot \TelegramBot\Api\Client | \TelegramBot\Api\BotApi
     */

    $token = env('BOT_TOKEN');
    $bot = new \TelegramBot\Api\Client($token);
    $host = env('BOT_HOST');
    $bot->deleteWebhook();
    if ($bot->getWebhookInfo()->getUrl() != '') {
        $bot->deleteWebhook();
    }
    $bot->setWebhook("$host/bot/public/$token/webhook");
    var_dump("Hook boldi");

});


Route::post("/" . env('BOT_TOKEN') . "/webhook", function () {
    /**
     *
     * @var $bot \TelegramBot\Api\Client | \TelegramBot\Api\BotApi
     */

    $bot = new \TelegramBot\Api\Client(env('BOT_TOKEN'));


    $bot->command(
        'start',
        \App\Telegram\Commands\StartCommand::handle($bot)
    );
    $bot->callbackQuery(

        static function (\TelegramBot\Api\Types\CallbackQuery $query) use ($bot) {
            try {
                $chatId = $query->getMessage()->getChat()->getId();
                $data = $query->getData();
                $messageId = $query->getMessage()->getMessageId();
                \App\Telegram\Callbacks\StartCallback::handle($bot, $query);
                $bot->answerCallbackQuery($query->getId(), "salomsalom", true);
            } catch (Exception $exception) {

            }
        });
    $bot->editedMessage(

        static function (\TelegramBot\Api\Types\Message $message) {
            echo "EDITED: " . $message->getText() . PHP_EOL;
        });
    $bot->on(
        static function (\TelegramBot\Api\Types\Update $update) use ($bot) {
            return true;
        },
        static function (\TelegramBot\Api\Types\Update $update) use ($bot) {


            try {
                $text = $update->getMessage()->getText();
                $contact_bor=$update->getMessage()->getContact();
                $back_massiv=['Orqaga','Back','Nazad'];
                $lang_massiv=['🇺🇿 Uzbek','🇬🇧 English','🇷🇺 Russkiy'];
                $lang_messages=['Keling tanishamiz!😁 Mening ismim Juju. Siznikichi?',"Let's meet!😁 My name is Juju. What is your name?",'Меня зовут Джуджу. А вы?'];
                $chatId = $update->getMessage()->getChat()->getId();
                $user = \App\Models\User::where('chat',$chatId)->first();

                if($contact_bor){

                    $user->update([
                       'status'=>'3'
                    ]);

                }
                if(in_array($text,$lang_massiv)){
                    $index= array_search($text,$lang_massiv);
                    $user = \App\Models\User::where('chat',$chatId)->first();
                    $user->update([
                       'lang'=>$index
                    ]);
                    if($user->name){

                    }else{

                        $back=$back_massiv[intval($user->lang)];
                        $keyboard=new ReplyKeyboardMarkup(
                            [
                                [
                                    [
                                        'text'=>$back
                                    ]
                                ]
                            ]
                            ,null,true);
                        $bot->sendMessage($chatId,$lang_messages[intval($user->lang)],'HTML',false,null,$keyboard);
                    }
                }
                else{
                    if(in_array($text,$back_massiv)){
                        if($user->status=='1'){
                            $keyboard = [];
                            foreach (array_chunk(['🇺🇿 Uzbek', '🇬🇧 English', '🇷🇺 Russkiy'], 2) as $key => $categories) {
                                $row = [];
                                foreach ($categories as $id => $category) {

                                    $row[] = [
                                        'text' => $category,

                                    ];


                                }
                                $keyboard[] = $row;
                            }
                            $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
                                $keyboard, true, true);
                            $bot->sendMessage($chatId, "<b>🇺🇿 Iltimos tilni tanlang!\n\n🇬🇧 Please! choose a language!\n\n🇷🇺 Пожалуйста, выберите язык!</b>", "HTML", false, null, $keyboard);

                        }

                    }
                    else{
                        $user->update([
                           'name'=>$text,
                           'status'=>2
                        ]);

                        if(intval($user->status) ==2){
                            $back = $back_massiv[intval($user->lang)];
                            $keyboard = new ReplyKeyboardMarkup([ [['text' => 'Raqam yuborish','request_contact'=>true]],  [['text' => $back]]], null, true);
                            $bot->sendMessage($chatId, "Raqam yuboring", 'HTML', false, null,  $keyboard);

                        }

                    }
                }








            } catch (Exception $e) {

            }

            return true;
        }
    );

    $bot->run();


})->name('webhook');


Route::redirect('/', 'login');

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Category
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoryController');

    // Sub Category
    Route::delete('sub-categories/destroy', 'SubCategoryController@massDestroy')->name('sub-categories.massDestroy');
    Route::resource('sub-categories', 'SubCategoryController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::resource('products', 'ProductController');

    // Order
    Route::delete('orders/destroy', 'OrderController@massDestroy')->name('orders.massDestroy');
    Route::resource('orders', 'OrderController');

    // Payment
    Route::delete('payments/destroy', 'PaymentController@massDestroy')->name('payments.massDestroy');
    Route::resource('payments', 'PaymentController');

    // Location
    Route::delete('locations/destroy', 'LocationController@massDestroy')->name('locations.massDestroy');
    Route::resource('locations', 'LocationController');

    // Yetkazib Berish
    Route::delete('yetkazib-berishes/destroy', 'YetkazibBerishController@massDestroy')->name('yetkazib-berishes.massDestroy');
    Route::resource('yetkazib-berishes', 'YetkazibBerishController');

    // About
    Route::delete('abouts/destroy', 'AboutController@massDestroy')->name('abouts.massDestroy');
    Route::resource('abouts', 'AboutController');

    // Contact
    Route::delete('contacts/destroy', 'ContactController@massDestroy')->name('contacts.massDestroy');
    Route::resource('contacts', 'ContactController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
