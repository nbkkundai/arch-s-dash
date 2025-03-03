<?php

namespace Modules\Dev\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DevController extends Controller
{
    public function __construct(){
        $this->dev_user_emails = ['vasheer@racvert.co.za', 'robert@racvert.co.za'];
    }

    /**
     * Check if the user is either vash or robert
     */
    public function devCheck()
    {
        $user = Auth::user();
        if (in_array($user->email, $this->dev_user_emails)) {
            return true;
        }else{
            abort(403);
        }
    }

    public function linkIndex()
    {
        $this->devCheck();
        $links = [
            'phpinfo' => '/dev/show-php-info',
            'logs' => '/dev/show-logs',
            'test-logs' => '/dev/test-logs',
            'email-logs' => '/dev/show-email-logs',
            'roles-and-perms' => '/dev/roles-and-perms',
            'my-perms' => '/dev/my-perms',
        ];
        return view('dev::index', compact('links'));
    }

    public function showLogs()
    {
        // $date = new Carbon($request->get('date',today()));
        $this->devCheck();
        $filePath = storage_path('logs/laravel.log');
        $data = [];
        if (File::exists($filePath)) {
            $data = [
                'lastModified' => new Carbon(File::lastModified($filePath)),
                'size' => File::size($filePath),
                'file' => File::get($filePath),
            ];
        }

        return view('dev::logs.index', compact('data'));
    }

    public function testLogs()
    {
        $this->devCheck();

        Log::critical('Logs are being tested by '.Auth::user());

        return 'Critical log recorded';
    }

    public function showEmailLogs()
    {
        // $date = new Carbon($request->get('date',today()));
        $this->devCheck();
        $filePath = storage_path('logs/email-records.log');
        $data = [];
        if (File::exists($filePath)) {
            $data = [
                'lastModified' => new Carbon(File::lastModified($filePath)),
                'size' => File::size($filePath),
                'file' => File::get($filePath),
            ];
        }

        return view('dev::logs.index', compact('data'));
    }
    
    public function phpinfo()
    {
        $this->devCheck();
        echo phpinfo();
    }

    public function rolesAndPerms()
    {
        $this->devCheck();
        return Role::with('permissions','users')->get();
    }

    public function myPerms()
    {
        $this->devCheck();
        return Auth::user()->getAllPermissions();
    }
}
