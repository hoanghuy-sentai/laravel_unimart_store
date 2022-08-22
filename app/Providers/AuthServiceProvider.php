<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*
        -------------------pageModule-------------------------
        */
        //list
        Gate::define('list_page_model', function ($user) {
            return  $user->right->polices[1]->list >0;
        });
        //add
        Gate::define('add_page_model', function ($user) {
            return  $user->right->polices[1]->add >0;
        });
        //delete
        Gate::define('delete_page_model', function ($user) {
            return $user->right->polices[1]->delete >0;
        });
        //update
        Gate::define('edit_page_model', function ($user) {
            return $user->right->polices[1]->edit >0;
        });
        /*
        -------------------postModule-------------------------
        */
        //list
        Gate::define('list_post_model', function ($user) {
            return  $user->right->polices[2]->list >0;
        });
        //add
        Gate::define('add_post_model', function ($user) {
            return  $user->right->polices[2]->add >0;
        });
        //delete
        Gate::define('delete_post_model', function ($user) {
            return $user->right->polices[2]->delete >0;
        });
        //update
        Gate::define('edit_post_model', function ($user) {
            return $user->right->polices[2]->edit >0;
        });
        /*
        -------------------rightModule-------------------------
        */
        //list
        Gate::define('list_right_model', function ($user) {
            return  $user->right->polices[6]->list >0;
        });
        //add
        Gate::define('add_right_model', function ($user) {
            return  $user->right->polices[6]->add >0;
        });
        //delete
        Gate::define('delete_right_model', function ($user) {
            return $user->right->polices[6]->delete >0;
        });
        //update
        Gate::define('edit_right_model', function ($user) {
            return $user->right->polices[6]->edit >0;
        });
        /*
        -------------------productModule-------------------------
        */
        //list
        Gate::define('list_product_model', function ($user) {
            return  $user->right->polices[3]->list >0;
        });
        //add
        Gate::define('add_product_model', function ($user) {
            return  $user->right->polices[3]->add >0;
        });
        //delete
        Gate::define('delete_product_model', function ($user) {
            return $user->right->polices[3]->delete >0;
        });
        //update
        Gate::define('edit_product_model', function ($user) {
            return $user->right->polices[3]->edit >0;
        });
        /*
        -------------------orderModule-------------------------
        */
        //list
        Gate::define('list_order_model', function ($user) {
            return  $user->right->polices[5]->list >0;
        });
        //add
        Gate::define('add_order_model', function ($user) {
            return  $user->right->polices[5]->add >0;
        });
        //delete
        Gate::define('delete_order_model', function ($user) {
            return $user->right->polices[5]->delete >0;
        });
        //update
        Gate::define('edit_order_model', function ($user) {
            return $user->right->polices[5]->edit >0;
        });
        /*
        -------------------slideModule-------------------------
        */
        //list
        Gate::define('list_slide_model', function ($user) {
            return  $user->right->polices[4]->list >0;
        });
        //add
        Gate::define('add_slide_model', function ($user) {
            return  $user->right->polices[4]->add >0;
        });
        //delete
        Gate::define('delete_slide_model', function ($user) {
            return $user->right->polices[4]->delete >0;
        });
        //update
        Gate::define('edit_slide_model', function ($user) {
            return $user->right->polices[4]->edit >0;
        });
        /*
        -------------------userModule-------------------------
        */
        //list
        Gate::define('list_slide_model', function ($user) {
            return  $user->right->polices[0]->list >0;
        });
        //add
        Gate::define('add_slide_model', function ($user) {
            return  $user->right->polices[0]->add >0;
        });
        //delete
        Gate::define('delete_slide_model', function ($user) {
            return $user->right->polices[0]->delete >0;
        });
        //update
        Gate::define('edit_slide_model', function ($user) {
            return $user->right->polices[0]->edit >0;
        });
        
    }
}
