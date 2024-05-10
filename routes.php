<?php
include_once 'config/static.php';
include_once 'controller/main.php';
include_once 'function/main_function.php';

# GET
Router::url('/', 'get', function () { return view('home'); });
Router::url('masuk', 'get', 'AuthController::masuk');
Router::url('daftar', 'get', 'AuthController::daftar');
Router::url('dashboard', 'get', 'DashboardController::index');
Router::url('dashboard/admin', 'get', 'DashboardController::admin');
Router::url('dashboard/contacts', 'get', 'DashboardController::contacts');
Router::url('dashboard/logout', 'get', 'AuthController::logout');
Router::url('contacts/add', 'get', 'ContactController::add');
Router::url('contacts/edit', 'get', 'ContactController::edit');
Router::url('contacts/delete', 'get', 'ContactController::delete');
Router::url('freshdb', 'get', 'freshdb');

# POST
Router::url('masuk', 'post', 'AuthController::saveMasuk');
Router::url('daftar', 'post', 'AuthController::saveDaftar');
Router::url('contacts/add', 'post', 'ContactController::saveAdd');
Router::url('contacts/edit', 'post', 'ContactController::saveEdit');

new Router();