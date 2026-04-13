<?php

declare(strict_types=1);

use Tabuna\Breadcrumbs\Trail;
use Illuminate\Support\Facades\Route;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Tests\TestScreen;
use App\Orchid\Screens\Blocks\BlockScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\Courses\CourseScreen;
use App\Orchid\Screens\Lessons\LessonScreen;
use App\Orchid\Screens\Tests\TestsListScreen;
use App\Orchid\Screens\Blocks\BlockListScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Groups\GroupEditScreen;
use App\Orchid\Screens\Groups\GroupListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use App\Orchid\Screens\Courses\CourseListScreen;
use App\Orchid\Screens\Lessons\LessonListScreen;
use App\Orchid\Screens\Statistic\StatisticScreen;
use App\Orchid\Layouts\Assignment\AssignmentTable;
use App\Orchid\Screens\Examples\ExampleGridScreen;
use App\Orchid\Screens\Assignment\AssignmentScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleActionsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Assignment\AssignmentListScreen;
use App\Orchid\Screens\Teacher\TeacherAssignmentScreen;
use App\Orchid\Screens\TestQuestion\TestQuestionScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\Teacher\AssignmentSubmissionScreen;
use App\Orchid\Screens\TestQuestion\TestQuestionListScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn(Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn(Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Роли'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Роли'), route('platform.systems.roles')));

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Example Screen'));

Route::screen('/examples/form/fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('/examples/form/advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');
Route::screen('/examples/form/editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('/examples/form/actions', ExampleActionsScreen::class)->name('platform.example.actions');

Route::screen('/examples/layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('/examples/grid', ExampleGridScreen::class)->name('platform.example.grid');
Route::screen('/examples/charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('/examples/cards', ExampleCardsScreen::class)->name('platform.example.cards');

Route::screen('/courses', CourseListScreen::class)
    ->name('platform.courses')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));
Route::screen('/courses/edit/{id}', CourseScreen::class)
    ->name('platform.courses.edit')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));
Route::screen('/courses/create', CourseScreen::class)
    ->name('platform.courses.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));


Route::screen('/blocks', BlockListScreen::class)
    ->name('platform.blocks')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));
Route::screen('/blocks/edit/{id}', BlockScreen::class)
    ->name('platform.blocks.edit')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));
Route::screen('/blocks/create', BlockScreen::class)
    ->name('platform.blocks.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));

Route::screen('/lessons', LessonListScreen::class)
    ->name('platform.lessons')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));
Route::screen('/lessons/edit/{id}', LessonScreen::class)
    ->name('platform.lessons.edit')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));
Route::screen('/lessons/create', LessonScreen::class)
    ->name('platform.lessons.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));

Route::screen('/tests', TestsListScreen::class)
    ->name('platform.tests')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));
Route::screen('/tests/edit/{id}', TestScreen::class)
    ->name('platform.tests.edit')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));
Route::screen('/tests/create', TestScreen::class)
    ->name('platform.tests.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));

Route::screen('/assignments', AssignmentListScreen::class)
    ->name('platform.assignments')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));
Route::screen('/assignments/edit/{id}', AssignmentScreen::class)
    ->name('platform.assignments.edit')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));
Route::screen('/assignments/create', AssignmentScreen::class)
    ->name('platform.assignments.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));

Route::screen('/tests-question', TestQuestionListScreen::class)
    ->name('platform.tests-question')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));
Route::screen('/tests-question/edit/{id}', TestQuestionScreen::class)
    ->name('platform.tests-question.edit')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));
Route::screen('/tests-question/create', TestQuestionScreen::class)
    ->name('platform.tests-question.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));

Route::screen('/groups', GroupListScreen::class)
    ->name('platform.groups')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));
Route::screen('/groups/edit/{id}', GroupEditScreen::class)
    ->name('platform.groups.edit')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));
Route::screen('/groups/create', GroupEditScreen::class)
    ->name('platform.groups.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));

Route::screen('/statistic', StatisticScreen::class)
    ->name('platform.statistics')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));

Route::screen('/assignment-submissions', TeacherAssignmentScreen::class)
    ->name('platform.assignment-submissions')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));
Route::screen('/assignment-submissions-view/{id}', AssignmentSubmissionScreen::class)
    ->name('platform.assignment-submissions-view')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index'));
// Route::screen('idea', Idea::class, 'platform.screens.idea');