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

// Public site
Route::get('/', 'PagesController@index');
Route::get('/courses', 'PagesController@courses');
Route::get('/courses/{course_id}', 'PagesController@view_course');
Route::get('/courses/{course_id}/enroll', 'MembersController@enroll_course');
Route::post('/courses/{course_id}/enroll/submit', 'MembersController@create_course_membership');
Route::get('/personal-coaching', 'PagesController@personal_coaching');
Route::post('/personal-coaching/enroll', 'MentorsController@enroll');
Route::get('/self-dev-quiz', 'PagesController@self_dev_quiz');
Route::post('/consultation/submit', 'PagesController@submit_free_consultation');
Route::get('/consultation/thank-you', 'PagesController@thank_you_consultation');
Route::get('/tools', 'PagesController@tools');
Route::get('/tools/pomodoro', 'PagesController@pomodoro');
Route::get('/tools/student', 'PagesController@student_planner');
Route::get('/tools/rice', 'PagesController@rice_planner');
Route::get('/focus/cheatsheet', 'PagesController@focus_cheatsheet');
Route::get('/habit-tracker', 'PagesController@habit_tracker');
Route::get('/book-club', 'PagesController@book_club');
Route::get('/test', 'PagesController@test');

// Admin functions
Route::get('/admin', 'AdminController@login');
Route::post('/admin/login/attempt', 'AdminController@attempt_login');
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('/admin/logout', 'AdminController@logout');

// Admin course functions
Route::get('/admin/courses', 'AdminController@view_all_courses');
Route::get('/admin/courses/new', 'AdminController@new_course');
Route::post('/admin/courses/create', 'AdminController@create_course');
Route::get('/admin/courses/edit/{course_id}', 'AdminController@edit_course');
Route::post('/admin/courses/update', 'CoursesController@update');
Route::get('/admin/courses/{course_id}/modules', 'AdminController@view_course_modules');
Route::post('/admin/courses/delete', 'AdminController@delete_course');
Route::get('/admin/courses/{course_id}/modules/new', 'AdminController@new_course_module');
Route::post('/admin/courses/modules/create', 'AdminController@create_course_module');
Route::get('/admin/courses/{course_id}/modules/{module_id}/content', 'AdminController@view_module_content');
Route::get('/admin/courses/{course_id}/modules/{module_id}/content/new', 'AdminController@new_module_content');
Route::post('/admin/courses/modules/content/create', 'AdminController@create_module_content');
Route::get('/admin/courses/{course_id}/modules/{module_id}/content/{content_id}/edit', 'AdminController@edit_content');
Route::post('/admin/courses/modules/content/update', 'AdminController@update_content');
Route::post('/admin/courses/modules/content/delete', 'AdminController@delete_content');
Route::post('/admin/modules/delete', 'AdminController@delete_course_module');
Route::get('/admin/courses/{course_id}/modules/{module_id}/edit', 'AdminController@edit_course_module');
Route::post('/admin/courses/modules/update', 'AdminController@update_course_module');

// Admin personal coaching functions
Route::get('/admin/personal-coaching', 'AdminController@view_personal_coaching');
Route::get('/admin/personal-coaching/mentee/{mentee_id}', 'AdminController@view_mentee');
Route::get('/admin/personal-coaching/mentee/{mentee_id}/documents/new', 'AdminController@new_mentee_document');
Route::post('/admin/personal-coaching/documents/create', 'AdminController@create_mentee_document');
Route::get('/admin/personal-coaching/mentee/{mentee_id}/documents/{document_id}/edit', 'AdminController@edit_mentee_document');
Route::post('/admin/personal-coaching/documents/update', 'AdminController@update_mentee_document');
Route::post('/admin/personal-coaching/documents/delete', 'AdminController@delete_mentee_document');
Route::get('/admin/personal-coaching/mentee/{mentee_id}/recommendations/new', 'AdminController@new_recommendation');
Route::post('/admin/personal-coaching/recommendations/create', 'AdminController@create_recommendation');
Route::get('/admin/personal-coaching/mentee/{mentee_id}/recommendations/{r_id}/edit', 'AdminController@edit_recommendation');
Route::post('/admin/personal-coaching/recommendations/update', 'AdminController@update_recommendation');
Route::post('/admin/personal-coaching/recommendations/delete', 'AdminController@delete_recommendation');
Route::get('/admin/personal-coaching/mentee/{mentee_id}/tasks/new', 'AdminController@new_task');
Route::post('/admin/personal-coaching/tasks/create', 'AdminController@create_task');
Route::get('/admin/personal-coaching/mentee/{mentee_id}/tasks/{task_id}/edit', 'AdminController@edit_task');
Route::post('/admin/personal-coaching/tasks/update', 'AdminController@update_task');
Route::post('/admin/personal-coaching/tasks/delete', 'AdminController@delete_task');
Route::get('/admin/personal-coaching/mentee/{mentee_id}/videos/new', 'AdminController@new_video');
Route::post('/admin/personal-coaching/videos/create', 'AdminController@create_video');
Route::get('/admin/personal-coaching/mentee/{mentee_id}/videos/{video_id}/edit', 'AdminController@edit_video');
Route::post('/admin/personal-coaching/videos/update', 'AdminController@update_video');
Route::post('/admin/personal-coaching/videos/delete', 'AdminController@delete_video');
Route::get('/admin/personal-coaching/consultations', 'AdminController@view_free_consultations');
Route::post('/admin/personal-coaching/consultations/update', 'AdminController@update_free_consultation');
Route::get('/admin/links/personal-coaching', 'AdminController@view_personal_coaching_link');
Route::get('/admin/personal-coaching/applications', 'MentorsController@admin_view_applications');

// Premium content functions
Route::get('/admin/premium', 'PremiumContentController@view_premium_content');
Route::get('/admin/premium/new', 'PremiumContentController@new_premium_content');

// Member functions
Auth::routes();
Route::get('/members/subscriptions', 'MembersController@subscriptions');
Route::get('/members/dashboard', 'MembersController@dashboard');
Route::get('/members/logout', 'MembersController@logout');

// Course functions
Route::get('/members/courses/{course_id}/dashboard', 'CoursesController@dashboard');
Route::get('/members/courses/{course_id}/modules/{module_id}', 'CoursesController@view_module');
Route::get('/members/courses/{course_id}/module/{module_id}/watch/{video_id}', 'CoursesController@view_video');
Route::get('/members/courses/{course_id}/forums/new', 'CoursesController@new_forum');
Route::post('/members/courses/forums/create', 'CoursesController@create_forum');
Route::get('/members/courses/{course_id}/forums/{forum_id}', 'CoursesController@view_forum');
Route::post('/members/courses/forums/comment/create', 'CoursesController@create_comment');
Route::get('/members/courses/complete/{course_id}/{video_id}', 'CourseCompletionsController@create');

// Personal coaching functions
Route::get('/members/personal-coaching', 'MentorsController@personal_coaching');
Route::get('/members/personal-coaching/tasks/{task_id}/edit', 'MentorsController@edit_task');
Route::post('/members/personal-coaching/tasks/update', 'MentorsController@update_task');
Route::get('/members/personal-coaching/appointments', 'MentorsController@view_open_appointments');

// Pomodoro tool functions
Route::get('/members/pomodoro', 'PomodoroController@view_sessions');
Route::get('/members/pomodoro/session', 'PomodoroController@new_session');
Route::post('/members/pomodoro/session/create', 'PomodoroController@create_session');

// Book club functions
Route::get('/members/book-club', 'MembersController@client_dashboard_book_club');
Route::get('/members/book-club/{book_id}/dashboard', 'BookClubController@book_dashboard');
Route::get('/admin/book-club', 'AdminController@admin_dashboard_book_club');
Route::get('/admin/book-club/{book_id}/dashboard', 'BookClubController@admin_dashboard_book');

// Book voting functions
Route::get('/admin/book-club/votes', 'BookPollsController@admin_dashboard');

// Student planner functions
Route::get('/members/student', 'StudentController@dashboard');
Route::get('/members/student/class/new', 'StudentController@new_class');
Route::post('/members/student/class/create', 'StudentController@create_class');
Route::get('/members/student/class/edit/{class_id}', 'StudentController@edit_class');
Route::post('/members/student/class/update', 'StudentController@update_class');
Route::post('/members/student/class/delete', 'StudentController@delete_class');
Route::get('/members/student/tasks/new', 'StudentController@new_task');
Route::post('/members/student/tasks/create', 'StudentController@create_task');
Route::get('/members/student/tasks/edit/{task_id}', 'StudentController@edit_task');
Route::post('/members/student/tasks/update', 'StudentController@update_task');
Route::post('/members/student/tasks/complete', 'StudentController@mark_complete');
Route::post('/members/student/tasks/delete', 'StudentController@delete_task');

// RICE planner functions
Route::get('/members/rice', 'RICEController@index');
Route::get('/members/rice/enroll', 'RICEController@start_trial');
Route::post('/members/rice/tasks/create', 'RICEController@create_task');
Route::post('/members/rice/tasks/delete', 'RICEController@delete_task');
Route::post('/members/rice/tasks/complete', 'RICEController@mark_complete');

// Blog post functions
Route::get('/blog', 'BlogPostsController@blog');
Route::get('/post/{post_id}/{slug}', 'BlogPostsController@read');
Route::get('/admin/posts', 'BlogPostsController@view_blog_posts');
Route::get('/admin/posts/edit/{post_id}', 'BlogPostsController@edit_blog_post');
Route::get('/admin/posts/new', 'BlogPostsController@new_blog_post');
Route::post('/admin/posts/create', 'BlogPostsController@create');
Route::post('/admin/posts/update', 'BlogPostsController@update');
Route::post('/admin/posts/delete', 'BlogPostsController@delete');
