<?php

namespace learn88\multirole;

use Illuminate\Console\Command;
use Illuminate\Console\DetectsApplicationNamespace;

class MultiAuthRoleCommand extends Command
{

      use DetectsApplicationNamespace;

      /**
       * The name and signature of the console command.
       *
       * @var string
       */
      protected $signature = 'learn88:multirole
                      {--views : Only scaffold the authentication views}
                      {--force : Overwrite existing views by default}';

      /**
       * The console command description.
       *
       * @var string
       */
      protected $description = 'Make MultiUser & MultiRole';

      /**
       * The views that need to be exported.
       *
       * @var array
       */
      protected $views = [
          'auth/index.stub' => 'auth/index.blade.php',
          'auth/login.stub' => 'auth/login.blade.php',
          'auth/profile.stub' => 'auth/profile.blade.php',
          'auth/register.stub' => 'auth/register.blade.php',
          'auth/role.stub' => 'auth/role.blade.php',
          'auth/show.stub' => 'auth/show.blade.php',
          'auth/passwords/email.stub' => 'auth/passwords/email.blade.php',
          'auth/passwords/reset.stub' => 'auth/passwords/reset.blade.php',
          'layouts/app.stub' => 'layouts/app.blade.php',
          'home.stub' => 'home.blade.php',
          'welcome.stub' => 'welcome.blade.php',
      ];
      protected $migrations = [
          '2014_10_12_000000_create_users_table.php' => '2014_10_12_000000_create_users_table.php',
          '2017_01_17_085616_create_roles_table.php'=> '2017_01_17_085616_create_roles_table.php',
          '2017_01_17_085724_create_user_role_table.php' => '2017_01_17_085724_create_user_role_table.php',
      ];
      protected $seeds = [
          'DatabaseSeeder.php' => '/DatabaseSeeder.php',
          'RoleTableSeeder.php' => '/RoleTableSeeder.php',
          'UserTableSeeder.php' => '/UserTableSeeder.php',
      ];
      protected $models = [
          'Role.php' => 'Role.php',
          'User.php' => 'User.php',
      ];
      protected $controllers = [
          'Auth/RegisterController.php' => '/Auth/RegisterController.php',
          'Auth/UserCtrl.php' => '/Auth/UserCtrl.php',
      ];
      protected $images = [
          'images/default.png' => '/user_images/default.png',
      ];
      protected $js = [
        'jasny-bootstrap.min.js' => 'jasny-bootstrap.min.js',
      ];
      protected $css = [
        'font-awesome.min.css' => 'font-awesome.min.css',
        'jasny-bootstrap.min.css' => 'jasny-bootstrap.min.css',
      ];
      protected $fonts => [
        'fontawesome-webfont.eot' => 'fontawesome-webfont.eot',
        'fontawesome-webfont.svg' => 'fontawesome-webfont.svg',
        'fontawesome-webfont.ttf' => 'fontawesome-webfont.ttf',
        'fontawesome-webfont.woff' => 'fontawesome-webfont.woff',
        'fontawesome-webfont.woff2' => 'fontawesome-webfont.woff2',
        'FontAwesome.otf' => 'FontAwesome.otf',
      ];


      /**
       * Execute the console command.
       *
       * @return void
       */
      public function handle()
      {
          $this->createDirectories();
          $this->exportViews();
          $this->exportMigrations();
          $this->exportSeeds();
          $this->exportModels();
          $this->exportControllers();
          $this->exportJs();
          $this->exportCss();
          $this->exportFonts();
          $this->exportImages();

          if (! $this->option('views')) {
              file_put_contents(
                  app_path('Http/Controllers/HomeController.php'),
                  $this->compileControllerStub()
              );

              // file_put_contents(
              //     app_path('Http/Kernel.php'),
              //     file_get_contents(__DIR__.'/stubs/make/routes.stub'),
              //     FILE_APPEND
              // );

              file_put_contents(
                  base_path('routes/web.php'),
                  file_get_contents(__DIR__.'/stubs/make/routes.stub'),
                  FILE_APPEND
              );

              $this->helper->replaceAndSave(getcwd().'/app/Http/Kernel.php', 'App\Providers\RouteServiceProvider::class,', $appConfigLine);
              $bar->advance();
          }

          $this->info('Laravel MultiRser & MultiRole successfully.');
      }

      /**
       * Create the directories for the files.
       *
       * @return void
       */
      protected function createDirectories()
      {
          if (! is_dir(resource_path('views/layouts'))) {
              mkdir(resource_path('views/layouts'), 0755, true);
          }

          if (! is_dir(resource_path('views/auth/passwords'))) {
              mkdir(resource_path('views/auth/passwords'), 0755, true);
          }

          if (! is_dir('uploads/user_images')) {
              mkdir('uploads/user_images', 0755, true);
          }

          if (! is_dir('fonts')) {
              mkdir('fonts', 0755, true);
          }
      }

      /**
       * Export the authentication views.
       *
       * @return void
       */
      protected function exportViews()
      {
          foreach ($this->views as $key => $value) {
              // if (file_exists(resource_path('views/'.$value)) && ! $this->option('force')) {
              //     if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
              //         continue;
              //     }
              // }

              copy(
                  __DIR__.'/stubs/make/views/'.$key,
                  resource_path('views/'.$value)
              );
          }
      }

      /**
       * Export the authentication migrations.
       *
       * @return void
       */
      protected function exportMigrations()
      {
          foreach ($this->migrations as $key => $value) {
              // if (file_exists(resource_path('database/migrations/'.$value)) && ! $this->option('force')) {
              //     if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
              //         continue;
              //     }
              // }

              copy(
                  __DIR__.'/stubs/make/migrations/'.$key,
                  base_path('database/migrations/'.$value)
              );
          }
      }

      /**
       * Export the authentication seeds.
       *
       * @return void
       */
      protected function exportSeeds()
      {
          foreach ($this->seeds as $key => $value) {
              // if (file_exists(resource_path('database/seeds/'.$value)) && ! $this->option('force')) {
              //     if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
              //         continue;
              //     }
              // }

              copy(
                  __DIR__.'/stubs/make/seeds/'.$key,
                  base_path('database/seeds/'.$value)
              );
          }
      }

      /**
       * Export the authentication models.
       *
       * @return void
       */
      protected function exportModels()
      {
          foreach ($this->models as $key => $value) {
              // if (file_exists(resource_path('app/'.$value)) && ! $this->option('force')) {
              //     if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
              //         continue;
              //     }
              // }

              copy(
                  __DIR__.'/stubs/make/models/'.$key,
                  base_path('app/'.$value)
              );
          }
      }

      /**
       * Export the authentication controllers.
       *
       * @return void
       */
      protected function exportControllers()
      {
          foreach ($this->controllers as $key => $value) {
              // if (file_exists(resource_path('app/Http/Controllers'.$value)) && ! $this->option('force')) {
              //     if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
              //         continue;
              //     }
              // }

              copy(
                  __DIR__.'/stubs/make/controllers/'.$key,
                  base_path('app/Http/Controllers'.$value)
              );
          }
      }

      /**
       * Export the authentication Jsavscript.
       *
       * @return void
       */
      protected function exportJs()
      {
          foreach ($this->js as $key => $value) {
              if (file_exists(base_path('public/js'.$value)) && ! $this->option('force')) {
                  if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
                      continue;
                  }
              }

              copy(
                  __DIR__.'/stubs/make/js/'.$key,
                  base_path('public/js'.$value)
              );
          }
      }

      /**
       * Export the authentication Jsavscript.
       *
       * @return void
       */
      protected function exportCss()
      {
          foreach ($this->css as $key => $value) {
              if (file_exists(base_path('public/css'.$value)) && ! $this->option('force')) {
                  if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
                      continue;
                  }
              }

              copy(
                  __DIR__.'/stubs/make/css/'.$key,
                  base_path('public/css'.$value)
              );
          }
      }


      /**
       * Export the authentication Jsavscript.
       *
       * @return void
       */
      protected function exportFonts()
      {
          foreach ($this->fonts as $key => $value) {
              if (file_exists(base_path('public/fonts'.$value)) && ! $this->option('force')) {
                  if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
                      continue;
                  }
              }

              copy(
                  __DIR__.'/stubs/make/fonts/'.$key,
                  base_path('public/fonts'.$value)
              );
          }
      }

      /**
       * Export the authentication controllers.
       *
       * @return void
       */
      protected function exportImages()
      {
          foreach ($this->controllers as $key => $value) {
              // if (file_exists(resource_path('app/Http/Controllers'.$value)) && ! $this->option('force')) {
              //     if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
              //         continue;
              //     }
              // }

              copy(
                  __DIR__.'/stubs/make/images/'.$key,
                  'uploads/user_images'.$value
              );
          }
      }

      /**
       * Compiles the HomeController stub.
       *
       * @return string
       */
      protected function compileControllerStub()
      {
          return str_replace(
              '{{namespace}}',
              $this->getAppNamespace(),
              file_get_contents(__DIR__.'/stubs/make/controllers/HomeController.stub')
          );
      }

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
}
