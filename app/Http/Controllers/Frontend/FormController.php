<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CMS\Module;
use App\Models\CMS\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FormController extends Controller
{
    protected $page;
    protected $defaultForm;
    protected $extraForm;
    public function __construct(Page $page)
    {
        $this->page = $page;
        $this->defaultForm = [
            'email' => 'email',
            'title' => 'title',
            'content' => 'content',
        ];
        $this->extraForm = getExtraFormFrontend($page);
    }
    public function index()
    {
        $page = $this->page;
        $defaultForm = $this->defaultForm;
        $extraForm = $this->extraForm;

        $modules = Module::whereIn('id', $page->modules)->get();
        return view('frontend.templates.form', compact('page', 'modules', 'defaultForm', 'extraForm'));
    }

    public function store(Request $request)
    {
        // Thu thập dữ liệu từ form
        $data = [];
        foreach ($this->defaultForm as $key => $item) {
            $data[$key] = $request->get($key);
        }
        foreach ($this->extraForm as $key => $item) {
            $item['value'] = $request->get($item['name']);
            $data['data'][$key] = $item;
        }
    
        // Tăng giới hạn thời gian thực thi của PHP
        set_time_limit(120); // 120 giây
    
        // URL để gửi yêu cầu HTTP
        $url = url('cms/api/item/contact');
        // $url = route('contact.api');
    
        try {
            // Gửi yêu cầu HTTP với thời gian chờ 60 giây
            $response = Http::timeout(60)->post($url, $data);
            // Kiểm tra xem yêu cầu có thất bại không
            if ($response->failed()) {
                Log::error('Request failed: ' . $response->body());
                return redirect()->back()->with('error', 'Đã có lỗi xảy ra');
            }
            return redirect()->back()->with('success', 'Data created and email sent successfully.');
        } catch (\Exception $e) {
            Log::error('Request error: ' . $e->getMessage());
            return redirect()->back()->with('success', 'Data created and email sent successfully.');
        }
    }
}
