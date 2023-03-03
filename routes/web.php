<?php

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


App::setLocale('ar');


Route::get('/', [App\Http\Controllers\homeController::class,"getHome"]);
// shop page
Route::get('/boutique',[App\Http\Controllers\shopController::class,"getShop"]);
Route::get('/boutique/{name}',[App\Http\Controllers\shopController::class,"getShopCategoty"]);
Route::get('/boutique/{name}/{subname}',[App\Http\Controllers\shopController::class,"getShopSubCategoty"]);
Route::get('/boutique/{name}/{subname}/{subsubname}',[App\Http\Controllers\shopController::class,"getShopSubSubCategoty"]);

// product
Route::get('/produit/{name}',[App\Http\Controllers\productController::class,"getSingleProduct"]);
Route::post('/produit/nouvelle-avis', [App\Http\Controllers\productController::class,"addReview"]);


Route::get('/contact',[App\Http\Controllers\contactController::class,"getForm"]);
Route::post('/contact',[App\Http\Controllers\contactController::class,"sendMessage"]);

Route::get('/panier',[App\Http\Controllers\cartController::class,"getCartProducts"]);

Route::get('/à-propos',[App\Http\Controllers\aboutController::class,"about"]);
// blogs
Route::get('/blogs',[App\Http\Controllers\blogController::class,"getBlogs"]);
Route::get('/blogs/{name}',[App\Http\Controllers\blogController::class,"getByCategory"]);
// post
Route::get('/article/{name}', [App\Http\Controllers\postController::class,"getPost"]);
Route::post('/article/nouveau-commentaire', [App\Http\Controllers\postController::class,"addComment"]);

Route::get('/comparer-les-produits', [App\Http\Controllers\productController::class,"getProfuctComparePage"]);

Route::post('/recherche', [App\Http\Controllers\searchController::class,"search"]);
Route::post('/commande-confirmée', [App\Http\Controllers\confirmeOrderController::class,"addSingleOrder"]);

// termes-et-conditions && privacy-policy
Route::get('/privacy-policy', [App\Http\Controllers\homeController::class,"getPrivacyPolicy"]);
Route::get('/termes-et-conditions', [App\Http\Controllers\homeController::class,"getTermesAndConditions"]);

// oder tracking
Route::get('/suivi-de-commande', [App\Http\Controllers\trackOrderController::class,"show"]);
Route::post('/suivi-de-commande', [App\Http\Controllers\trackOrderController::class,"getOrderStates"]);
Route::get('/suivi-de-commande/détails-de-la-commande/{code}', [App\Http\Controllers\trackOrderController::class,"getDetails"]);

Route::post('/finalisation-de-commande', [App\Http\Controllers\checkoutController::class,"getForm"]);
Route::get('/finalisation-de-commande', [App\Http\Controllers\checkoutController::class,"sendToPanier"]);
Route::post('/confirmer-la-commande', [App\Http\Controllers\checkoutController::class,"addOrder"]);
Route::get('/commandez-maintenant/{id}/{qte}', [App\Http\Controllers\directCheckoutController::class,"getorderData"]);

/*
Route::get('/page', function () {
 return view('page');
});*/

Route::get('404', [App\Http\Controllers\homeController::class,"return404"]);


Route::get('/recherche/catégorie/{name}', [App\Http\Controllers\searchController::class,"getSearch"]);
// Ajax
Route::get('/ajax/addToCart/{id}', [App\Http\Controllers\ajaxController::class,"addToCart"]);
Route::get('/ajax/removeFromCart/{id}',  [App\Http\Controllers\ajaxController::class,"removeFromCart"]);
Route::any('/ajax/getRandomeProduct',  [App\Http\Controllers\ajaxController::class,"getRandomeProduct"]);
Route::any('/ajax/desableOrderNotice',  [App\Http\Controllers\ajaxController::class,"desableOrderNotice"]);
Route::any('/ajax/desableChatMessage',  [App\Http\Controllers\ajaxController::class,"desableChatMessage"]);
Route::post('/ajax/newsletter/register',  [App\Http\Controllers\ajaxController::class,"newsletterRegister"]);
Route::get('/ajax/post/newshare/{id}',  [App\Http\Controllers\ajaxController::class,"newShare"]);



/*///
    /////
        ////
            ////
                Admin routs
            ////
        ////
    ////
*////
// Admin


Route::get('/admin', [App\Http\Controllers\admin\homeController::class,"show"])->name('admin')->middleware('userlogin');

// Comments
Route::get('/admin/commontaires/tous', [App\Http\Controllers\admin\commentsController::class,"show"])->middleware('userlogin');
Route::get('/admin/commontaires/approver/{id}', [App\Http\Controllers\admin\commentsController::class,"approveComment"])->middleware('userlogin');
Route::get('/admin/commontaires/disapprover/{id}', [App\Http\Controllers\admin\commentsController::class,"disapproveComment"])->middleware('userlogin');
Route::get('/admin/commontaires/supprimer/{id}', [App\Http\Controllers\admin\commentsController::class,"deleteComment"])->middleware('userlogin');

// Medias
Route::get('/admin/medias/tous', [App\Http\Controllers\admin\mediasController::class,"show"])->middleware('userlogin');
Route::get('/admin/medias/getjson', [App\Http\Controllers\admin\mediasController::class,"getAllAsJson"])->middleware('userlogin');
Route::post('/admin/medias/ajouter', [App\Http\Controllers\admin\mediasController::class,"addNewMedias"])->middleware('userlogin');
Route::post('/admin/medias/ajouter-ajax', [App\Http\Controllers\admin\mediasController::class,"addNewAjaxMedias"])->middleware('userlogin');

Route::post('/admin/medias/modifier', [App\Http\Controllers\admin\mediasController::class,"updateMedias"])->middleware('userlogin');


// Messages
Route::get('/admin/messages/tous', [App\Http\Controllers\admin\messagesController::class,"show"])->middleware('userlogin');
Route::get('/admin/messages/marquer-comme-lu/{id}', [App\Http\Controllers\admin\messagesController::class,"setAsRead"])->middleware('userlogin');
Route::get('/admin/messages/marquer-comme-non-lu/{id}', [App\Http\Controllers\admin\messagesController::class,"setAsUnread"])->middleware('userlogin');
Route::get('/admin/messages/supprimer/{id}', [App\Http\Controllers\admin\messagesController::class,"deleteMessage"])->middleware('userlogin');

// Newsletter
Route::get('/admin/newsletter/tous', [App\Http\Controllers\admin\NewsletterController::class,"show"])->middleware('userlogin');

// Orders
Route::get('/admin/commandes/tous', [App\Http\Controllers\admin\ordersController::class,"show"])->middleware('userlogin');
Route::get('/admin/commandes/details/{id}', [App\Http\Controllers\admin\ordersController::class,"getJsonOrderDetails"])->middleware('userlogin');
Route::get('/admin/commandes/modifier/{id}', [App\Http\Controllers\admin\ordersController::class,"getOrder"])->middleware('userlogin');
Route::get('/admin/commandes/marquer-la-note-comme-terminer/{id}/{orderId}',[App\Http\Controllers\admin\ordersController::class,"setNoteAsDone"])->middleware('userlogin');
Route::get('/admin/commandes/marquer-la-note-comme-en-cours/{id}/{orderId}',[App\Http\Controllers\admin\ordersController::class,"setNoteAsProgress"])->middleware('userlogin');
Route::get('/admin/commandes/supprimer-la-note/{id}/{orderId}',[App\Http\Controllers\admin\ordersController::class,"deleteNote"])->middleware('userlogin');
Route::post('/admin/commandes/ajouter-une-note', [App\Http\Controllers\admin\ordersController::class,"addNewNote"])->middleware('userlogin');
Route::get('/admin/commandes/modifier-etat/{state}/{orderId}', [App\Http\Controllers\admin\ordersController::class,"editOrderState"])->middleware('userlogin');
Route::get('/admin/commandes/supprimer/{id}', [App\Http\Controllers\admin\ordersController::class,"deleteOrder"])->middleware('userlogin');

// Post
Route::get('/admin/articles/tous', [App\Http\Controllers\admin\postsController::class,"show"])->middleware('userlogin');
Route::get('/admin/article/passer-au-brouillon/{id}', [App\Http\Controllers\admin\postsController::class,"moveToDraft"])->middleware('userlogin');
Route::get('/admin/article/etat/publier/{id}', [App\Http\Controllers\admin\postsController::class,"moveTopublished"])->middleware('userlogin');
Route::get('/admin/article/modifier/{id}', [App\Http\Controllers\admin\postsController::class,"getPostForEdit"])->middleware('userlogin');
Route::post('/admin/articles/modifier', [App\Http\Controllers\admin\postsController::class,"editPost"])->middleware('userlogin');
Route::post('/admin/article/supprimer/{id}', [App\Http\Controllers\admin\postsController::class,"deletePost"])->middleware('userlogin');
Route::get('/admin/articles/nouveau', [App\Http\Controllers\admin\postsController::class,"NewPost"])->middleware('userlogin');
Route::post('/admin/articles/ajouter', [App\Http\Controllers\admin\postsController::class,"addNewPost"])->middleware('userlogin');
Route::get('/admin/articles/categories', [App\Http\Controllers\admin\postsController::class,"getBlogCategories"])->middleware('userlogin');
Route::post('/admin/articles/categories/ajouter', [App\Http\Controllers\admin\postsController::class,"addNewCategory"])->middleware('userlogin');
Route::get('/admin/articles/categories/modifier/{id}', [App\Http\Controllers\admin\postsController::class,"getCategoryForEdit"])->middleware('userlogin');
Route::post('/admin/articles/categories/modifier', [App\Http\Controllers\admin\postsController::class,"editCategory"])->middleware('userlogin');
Route::get('/admin/articles/categories/supprimer/{id}', [App\Http\Controllers\admin\postsController::class,"deleteCategory"])->middleware('userlogin');

// Product
Route::get('/admin/produit/tous', [App\Http\Controllers\admin\productController::class,"show"])->middleware('userlogin');
Route::get('/admin/produit/ajouter', [App\Http\Controllers\admin\productController::class,"newproduct"])->middleware('userlogin');
Route::post('/admin/produit/ajouter', [App\Http\Controllers\admin\productController::class,"addNewProduct"])->middleware('userlogin');
Route::get('/admin/produit/publier/{id}', [App\Http\Controllers\admin\productController::class,"publish"])->middleware('userlogin');
Route::get('/admin/produit/passer-au-brouillon/{id}', [App\Http\Controllers\admin\productController::class,"moveToDraft"])->middleware('userlogin');
Route::get('/admin/produit/modifier/{id}', [App\Http\Controllers\admin\productController::class,"getEditPage"])->middleware('userlogin');
Route::post('/admin/produit/modifier', [App\Http\Controllers\admin\productController::class,"edit"])->middleware('userlogin');
Route::get('/admin/produit/supprimer/{id}', [App\Http\Controllers\admin\productController::class,"delete"])->middleware('userlogin');
Route::get('/admin/produit/categories',[App\Http\Controllers\admin\productController::class,"getAllcategorys"])->middleware('userlogin');
Route::post('/admin/produit/categories/ajouter',[App\Http\Controllers\admin\productController::class,"addNewCategory"])->middleware('userlogin');
Route::get('/admin/produit/categories/supprimer/{id}',[App\Http\Controllers\admin\productController::class,"deleteCategory"])->middleware('userlogin');
Route::get('/admin/produit/categories/modifier/{id}',[App\Http\Controllers\admin\productController::class,"getCategoryEdtiPage"])->middleware('userlogin');
Route::post('/admin/produit/categories/modifier',[App\Http\Controllers\admin\productController::class,"edticategory"])->middleware('userlogin');

// settings
Route::get('/admin/parametres',[App\Http\Controllers\admin\settingController::class,"show"])->middleware('userlogin');
Route::post('/admin/parametres/modifier-infos-site', [App\Http\Controllers\admin\settingController::class,"editSiteInfos"])->middleware('userlogin');
Route::post('/admin/parametres/modifier-site-logo', [App\Http\Controllers\admin\settingController::class,"editSitelogo"])->middleware('userlogin');
Route::post('/admin/parametres/modifier-site-icon', [App\Http\Controllers\admin\settingController::class,"editSiteIcon"])->middleware('userlogin');
Route::post('/admin/parametres/modifier-site-social-image', [App\Http\Controllers\admin\settingController::class,"editSocialImage"])->middleware('userlogin');
Route::post('/admin/parametres/modifier-site-social-liens', [App\Http\Controllers\admin\settingController::class,"editSocialLinks"])->middleware('userlogin');
Route::post('/admin/parametres/modifier-politiques', [App\Http\Controllers\admin\settingController::class,"editPrivacy"])->middleware('userlogin');
Route::post('/admin/parametres/modifier-termes', [App\Http\Controllers\admin\settingController::class,"editTerms"])->middleware('userlogin');
Route::post('/admin/parametres/modifier-widget1', [App\Http\Controllers\admin\settingController::class,"editWidjet1"])->middleware('userlogin');
Route::post('/admin/parametres/modifier-widget2', [App\Http\Controllers\admin\settingController::class,"editWidjet2"])->middleware('userlogin');
Route::post('/admin/parametres/modifier-widget3', [App\Http\Controllers\admin\settingController::class,"editWidjet3"])->middleware('userlogin');

Route::get('/admin/parametres/bannieres', [App\Http\Controllers\admin\settingController::class,"getBanners"])->middleware('userlogin');
Route::post('/admin/parametres/bannieres/modifier', [App\Http\Controllers\admin\settingController::class,"editBanners"])->middleware('userlogin');

Route::get('/admin/parametres/villes', [App\Http\Controllers\admin\settingController::class,"getCities"])->middleware('userlogin');
Route::post('/admin/parametres/villes/modifier', [App\Http\Controllers\admin\settingController::class,"editCities"])->middleware('userlogin');
Route::get('/admin/parametres/villes/supprimer/{id}', [App\Http\Controllers\admin\settingController::class,"deleteCities"])->middleware('userlogin');


Route::get('/admin/parametres/cartes', [App\Http\Controllers\admin\settingController::class,"getCartes"])->middleware('userlogin');
Route::post('/admin/parametres/cartes/modifier', [App\Http\Controllers\admin\settingController::class,"editCartes"])->middleware('userlogin');

Route::get('/admin/parametres/hf-codes', [App\Http\Controllers\admin\settingController::class,"getHFcodes"])->middleware('userlogin');
Route::post('/admin/parametres/hf-codes/modifier/Codes-en-tete', [App\Http\Controllers\admin\settingController::class,"editHeaderCode"])->middleware('userlogin');
Route::post('/admin/parametres/hf-codes/modifier/avant-body', [App\Http\Controllers\admin\settingController::class,"editbeforeBodyCode"])->middleware('userlogin');
Route::post('/admin/parametres/hf-codes/modifier/Codes-de-pied', [App\Http\Controllers\admin\settingController::class,"edirFooterCode"])->middleware('userlogin');
Route::post('/admin/parametres/hf-codes/modifier/apres-body', [App\Http\Controllers\admin\settingController::class,"editAfterBodyCode"])->middleware('userlogin');


// users
Route::get('/admin/utilisateurs/tous', [App\Http\Controllers\admin\userController::class,"show"])->middleware('userlogin');
Route::get('/admin/utilisateurs/ajouter', [App\Http\Controllers\admin\userController::class,"getNewUserPage"])->middleware('userlogin');
Route::post('/admin/utilisateurs/ajouter', [App\Http\Controllers\admin\userController::class,"addNewUser"])->middleware('userlogin');
Route::get('/admin/utilisateurs/bloquer/{id}', [App\Http\Controllers\admin\userController::class,"blockUser"])->middleware('userlogin');
Route::get('/admin/utilisateurs/debloquer/{id}', [App\Http\Controllers\admin\userController::class,"unBlockUser"])->middleware('userlogin');
Route::get('/admin/utilisateurs/supprimer/{id}', [App\Http\Controllers\admin\userController::class,"deleteUser"])->middleware('userlogin');
Route::get('/admin/utilisateurs/modifier/{id}', [App\Http\Controllers\admin\userController::class,"getUsereditPage"])->middleware('userlogin');
Route::post('/admin/utilisateurs/modifier', [App\Http\Controllers\admin\userController::class,"editUser"])->middleware('userlogin');
Route::post('/admin/utilisateurs/modifier/mot-de-pass', [App\Http\Controllers\admin\userController::class,"editUserPassword"])->middleware('userlogin');

// auth
Route::get('/login',[App\Http\Controllers\admin\userController::class,"getAuthPage"])->name('login');
Route::post('/admin/utilisateurs/auth',[App\Http\Controllers\admin\userController::class,"userlogin"]);
Route::get('/admin/utilisateurs/deconnecter',[App\Http\Controllers\admin\userController::class,"logOut"]);

// instagram posts
Route::post('/admin/parametres/instagram-posts',[App\Http\Controllers\admin\settingController::class,"updateInstagramPhotos"]);

/////////////////////////////////////////////
