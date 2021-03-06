<?php

use App\Http\Controllers\InspectionController;
use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\UserCollection;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/v1'], function () {
    //用户微信登录
    Route::any('/user/login', 'UserController@wxLogin');
    //获取用户信息
    Route::get('/users', 'UserController@getUser');
    //用户注销
    Route::post('/user/logout', 'UserController@wxLogout');
    //获取单个用户
    Route::get('/users/{id}','UserController@getOneUser');
    //修改用户信息
    Route::put('/users/{id}','UserController@updateUser');
    //删除用户
    Route::delete('/users/{id}','UserController@deleteUser');
    //判断用户权限
    Route::get('/users/permissions/{id}','UserController@hasPermission');
    //用户搜索
    Route::get('/searchUser','UserController@searchUser');
    Route::post('/updateUserInfo','UserController@updateUserInfo');

    //获取设备列表
    Route::get('/equipments', 'EquipmentController@getEquipment');
    //新增设备
    Route::post('/equipment/add', 'EquipmentController@addEquipment');
    //获取单个设备信息
    Route::get('/equipment/{id}', 'EquipmentController@getOneEquipment');
    //通过实验室id获取实验室名称TODO:可优化
    Route::get('/equipment/getlaboratory/{id}', 'EquipmentController@getLaboratory');
    //修改设备信息
    Route::put('/equipment/{id}', 'EquipmentController@updateEquipment');
    //删除设备信息
    Route::delete('/equipment/{id}', 'EquipmentController@deleteEquipment');
    //设备搜索
    Route::get('/searchEquipment','EquipmentController@searchEquipment');


    //获取药品列表
    Route::get('/chemical','ChemicalController@getChemical');
    //药品入库
    Route::post('/chemical/inout','ChemicalController@inout');
    //出入库确认
    Route::put('/chemical/confirm','ChemicalController@inoutConfirm');
    //2驳回后1收到信息后确认
    Route::put('/chemical/know','ChemicalController@know');


    //获取实验室地址列表
    Route::get('/getlaboratory/List/{unit_id}', 'EquipmentController@getLaboratoryList');

    //隐患上传
    Route::post('/hiddens','HiddenController@addHidden');
    //获取隐患列表
    Route::get('/hiddens','HiddenController@getHidden');
    //保存隐患照片
    Route::post('/hiddens/upload','HiddenController@saveHiddenImage');

    //邮件发送
    Route::get('/mail','MailController@sendEmail');

    //短信发送

    //下发通知
    Route::get('/notice','NoticeController@getList');
    Route::get('/noticeIndex','NoticeController@getIndex');
    Route::post('/notice/imgUpload','NoticeController@saveImage');
    Route::post('/notice/fileUpload','NoticeController@saveFile');
    Route::post('/notice/saveData','NoticeController@saveData');
    Route::get('/notice/getSomeoneNoticeList','NoticeController@getOwnerList');
    Route::get('/notice/getTime','NoticeController@getTime');
    Route::get('/notice/getOneNotice','NoticeController@getOneNotice');

    //获取隐患详情
    Route::put('/hiddens/{id}','HiddenController@getHiddenDetail');
    //隐患处理Log
    Route::post('/hiddensLog','HiddenController@addHiddenLog');


    //消息列表
    Route::get('/notice/notices','NoticeController@getAllMessage');
    Route::get('/notice/receiveNotice','NoticeController@receiveNotice');
    Route::get('/notice/getHistoryMessage','NoticeController@getHistoryMessage');

    //清除缓存
    Route::get('/clearAllMessage','NoticeController@clearAllCache');
    Route::get('/clearHistoryMessage','NoticeController@clearHistoryCache');

    //电子巡检
    Route::get('/inspections','InspectionController@getInspections');
    Route::put('/inspections/{id}','InspectionController@confirmInspection');
    //巡检记录
    Route::get('/inspectionRecords','InspectionController@getInspectionRecords');

    Route::post('/createClassLog','ClassLogController@createClassLog');
    Route::get('/classLog','ClassLogController@getClassLog');
    Route::get('/getLaboratoryList','ClassLogController@getLaboratoryList');

    //在线考试
    Route::get('/getQuestions','ExamController@getQuestions');
    //提交考试成绩
    Route::post('/submitAchievement','ExamController@submitAchievement');


    // 测试excel
    Route::get('/excel', 'ExamController@upload');
});
