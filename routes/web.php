<?php



use App\Http\Controllers\TonerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;

Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
Route::post('/chatbot/message', [ChatbotController::class, 'chat'])->name('chatbot.message');
Route::get('/chatbot/health', [ChatbotController::class, 'health'])->name('chatbot.health');

/* Auth Route::get('signup', 'App\Http\Controllers\Auth\RegisterController@signup')->name('signup');*/

Route::get('signupstarsmotors', 'App\Http\Controllers\Auth\RegisterController@signup')->name('signup');

Route::get('/panelclientes',  [App\Http\Controllers\SiteController::class, 'panelclientes']  )->name('panelclientes');

Route::match(['get','post'],'/',  [App\Http\Controllers\SiteController::class, 'index']  )->name('site');
Route::get( '/producto/{id}',    [App\Http\Controllers\SiteController::class, 'index'] )->name('ver.producto');
Route::get( '/promoid/{id}',     [App\Http\Controllers\SiteController::class, 'promoid'] )->name('ver.promoid');
Route::get( '/promocion/{id}',   [App\Http\Controllers\SiteController::class, 'promo'] )->name('ver.promo');
Route::get( '/busqueda/{id?}',   [App\Http\Controllers\SiteController::class, 'index'] )->name('url.busqueda');
Route::get( '/promociones/{busqueda?}',  [App\Http\Controllers\SiteController::class, 'promociones'] )->name('url.busquedapromo');
Route::post( '/gourlpromo',  [App\Http\Controllers\SiteController::class, 'gourlpromo'] )->name('gourlpromo');
Route::post( '/gourl',  [App\Http\Controllers\SiteController::class, 'gourl'] )->name('gourl');
Route::get( '/instancia/{id}',  [App\Http\Controllers\SiteController::class, 'index'] )->name('url.instancia');
Route::get( '/pagar/{amount}',  [App\Http\Controllers\SiteController::class, 'pago'] )->name('pagar.monto');
Route::put( '/procesar/pago',  [App\Http\Controllers\SiteController::class, 'procesar'] )->name('procesar.pago');
Route::put( '/encoded/msg',  [App\Http\Controllers\SiteController::class, 'encoded'] )->name('encode.msg');
Route::get('/agregar/producto',  [App\Http\Controllers\ComprasController::class, 'agregar']  )->name('agregar.producto');
Route::get('/actualizar/agregados',  [App\Http\Controllers\SiteController::class, 'agregados'] )->name('actualizar.agregados');
Route::get('/abrir/lista',  [App\Http\Controllers\ComprasController::class, 'abrirlista']  )->name('abrir.lista');
Route::post('/update/csrf',  [App\Http\Controllers\SiteController::class, 'tokencsrf'] )->name('update.csrf');



Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Auth::routes();

// Route::post('login', 'Auth\LoginController@login')->name('login');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('register', 'Auth\RegisterController@register')->name('register');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');


Auth::routes(['verify' => true]);

Route::group(['prefix' => 'error'], function(){
    Route::get('404', function () { return view('error.404'); });
    Route::get('500', function () { return view('error.500'); });
});


Route::middleware(['check.admin'])->group(function () {

    Route::post('promo/update',[\App\Http\Controllers\PromocionController::class, 'update'])->name('promo.update');
    Route::post('promo/open',[\App\Http\Controllers\PromocionController::class, 'open'])->name('promo.open');
    Route::post('promo/refresh',[\App\Http\Controllers\PromocionController::class, 'promoid'])->name('promo.id');
    Route::post('promo/delete',[\App\Http\Controllers\PromocionController::class, 'delete'])->name('promo.delete');
    Route::get('limpiar/promociones',[\App\Http\Controllers\PromocionController::class, 'limpiar'])->name('limpiar.promociones');
    Route::post('upload/imagen/promo/{id}',[\App\Http\Controllers\PromocionController::class, 'imagen'])->name('upload.imagen');
    Route::post('upload/imagenhome/promo/{id}',[\App\Http\Controllers\PromocionController::class, 'imagenhome'])->name('upload.imagenhome');
    Route::delete('destroy/imagen/promo/{id}',[\App\Http\Controllers\PromocionController::class, 'destroyimagen'])->name('promo.destroyimagen');
    Route::delete('destroy/imagenhome/promo/{id}',[\App\Http\Controllers\PromocionController::class, 'destroyimagenhome'])->name('promo.destroyimagenhome');


    Route::resource('promos', \App\Http\Controllers\PromocionController::class);

    Route::resource('iaknowledge', \App\Http\Controllers\IAController::class);
    Route::get('iaknowledge-search', [\App\Http\Controllers\IAController::class, 'search'])->name('iaknowledge.search');


});

Route::middleware(['auth'])->group(function () {

    Route::match(['get','post'],'/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('logout',[\App\Http\Controllers\Auth\LoginController::class, 'logout']);

    Route::resource('compraitems', \App\Http\Controllers\CompraItemsController::class);

    Route::get('/bienvenido', [\App\Http\Controllers\SiteController::class, 'bienvenido'])->name('bienvenido');
  //  Route::get('components/{any}', [TonerController::class, 'components']);


    Route::prefix('chat')->name('chat.')->group(function () {
        Route::get('/conversations', [\App\Http\Controllers\ChatConversationController::class, 'index'])->name('index');
        Route::post('/conversations/{id}', [\App\Http\Controllers\ChatConversationController::class, 'show'])->name('show');
        Route::put('/conversations/{id}/status', [\App\Http\Controllers\ChatConversationController::class, 'updateStatus'])->name('update-status');
        Route::delete('/conversations/{id}', [\App\Http\Controllers\ChatConversationController::class, 'destroy'])->name('destroy');
        Route::get('/export', [\App\Http\Controllers\ChatConversationController::class, 'export'])->name('export');
        Route::get('/stats', [\App\Http\Controllers\ChatConversationController::class, 'stats'])->name('stats');
    });

});


Route::post('/chat/initialize', [ChatbotController::class, 'initialize'])->name('chat.initialize');
Route::post('/chat/message', [ChatbotController::class, 'message'])->name('chatbot.message');
Route::post('/chat/end', [ChatbotController::class, 'endConversation'])->name('chat.end');
