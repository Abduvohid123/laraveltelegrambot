<?php


use Illuminate\Support\Facades\Route;
use TelegramBot\Api\Types\Message;

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
     *
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
                $chatId = $update->getMessage()->getChat()->getId();

                $bot->sendMessage($chatId, strrev($text));

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
