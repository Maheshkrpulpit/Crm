<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Translate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Symfony\Component\Yaml\Yaml;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {

        if (request()->ajax()) {

            $languages = Language::where('id', '>', 0);

            return Datatables::of($languages)
                ->addColumn(
                    'action',
                    function ($row) {
                        $html = '';
                        if ($row->id != 1) {
                            $html .= '<button data-href="' . route("settings.language.destroy", $row->id) . '" class="btn btn-outline-danger btn-icon waves-effect waves-light delete_language_button",  data-bs-trigger="hover", data-bs-placement="top", title="' . lang("Delete") . '" ><i class="ri-delete-bin-5-line"></i></button>&nbsp;';
                        }
                        $html .= '<a href="' . route("settings.language.translate", [$row->code]) . '" class="btn btn-outline-primary btn-icon waves-effect waves-light",data-bs-trigger="hover", data-bs-placement="top", title="' . lang("Translate") . '"><i class="ri-translate" ></i></a>
                        &nbsp;';
                        '&nbsp;';
                        '&nbsp;';
                        '&nbsp;';
                        '<br>';

                        return $html;
                    }
                )
                ->editColumn('status', function ($row) {
                    if ($row->id != 1) {
                        $check = $row->status ? 'checked' : '';
                        $html = '<div class="form-check form-switch form-switch-custom form-switch-success"><input onchange="updateStatus(this)" class="form-check-input" type="checkbox" role="switch" id="SwitchCheck11' . $row->id . '" ' . $check . ' value="' . $row->id . '"><label class="form-check-label" for="SwitchCheck11' . $row->id . '"></label></div>';
                        return $html;
                    }
                })
                ->removeColumn('id')
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.settings.language.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.language.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:languages,name', 'code' => 'required|unique:languages,code']);
        // $request->validate(['file' => 'required|unique:languages,file', 'file' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:min_width=32,min_height=32,file']);
        // $path =$request->file('file')->storeAs('image',$fileName,'public');

       
        


        try {

            $request->merge(['created_by' => auth()->id()]);
            $request->merge(['code' => strtolower($request->code)]);
            $language = Language::create($request->all());
           

            /* if (!is_dir(base_path('lang/' . $lang['code']))) {
                 File::copyDirectory(base_path("lang/en"), base_path("lang/") . $lang['code']);
             }*/

            if ($language) {
                $translates = Translate::where('lang_code', defaultLanguage())->get();

                foreach ($translates as $translate) {
                    $value = ($request->code == defaultLanguage()) ? $translate->key : null;
                    $lang = new Translate();
                    $lang->lang_code = $request->code;
                    $lang->group_langname = $translate->group_langname;
                    $lang->key = $translate->key;
                    $lang->value = $value;
                    $lang->save();
                }

                /*  if ($request->has('is_default')) {
                      $data['default_lang'] = removeSpaces($language->code);
                      $this->updateSettings($data);
                  }*/
            }

            $output = [
                'success' => 1,
                'msg' => lang("Language Added Successfully", "alerts")
            ];

            return redirect()->route('settings.language.index')->with('status', $output);

        } catch (\Exception $e) {

            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => lang("language was successfully updated", 'alerts')
            ];

            return redirect()->back()->with('status', $output);

        }


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Language $language
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Language $language)
    {

        $content = Yaml::dump($language->getLocaleArrayFromFile());

        return view('admin.settings.language.show', compact('language', 'content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Language $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Language $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Language $language)
    {
        $request->validate([$language->code => 'required']);
        try {

            $callback = $language->updateFromYaml($request->all()[$language->code]);
            $output = [
                'success' => true,
                'msg' => lang("Language is updated successfully", 'alerts')
            ];
            return redirect()->route('settings.language.index')->with('status', $output);
        } catch (ParseException $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = [
                'success' => false,
                'msg' => lang("messages.something_went_wrong", 'alerts')
            ];

            return redirect()->back()->with('status', $output);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Language $language
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->ajax()) {
            try {
                $language = Language::find($id);
                $language->delete();
                $output = [
                    'success' => true,
                    'msg' => lang("Language is deleted successfully", 'alerts')
                ];
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

                $output = [
                    'success' => false,
                    'msg' => lang("messages.something_went_wrong", 'alerts')
                ];
            }

            return $output;
        }
    }

    public function updateStatus(Language $language)
    {

        try {

            $language->status = !$office->status;

            $language->save();

            return array('status' => 1, 'message' => lang('Status updated successfully.', 'alerts'), 'type' => 'success');

        } catch (Exception $e) {

            if (config('app.debug') == true):

                return [
                    'status' => 0,
                    'message' => $e->getMessage(),
                    'type' => 'danger',
                ];

            endif;

            return array('status' => 1, 'message' => lang('Something went wrong', 'alerts'), 'type' => 'danger');


        }


    }

    /**
     * Display the specified resource.
     *
     * @param  $lang Language code
     * @param  $group Translate group
     * @return \Illuminate\Http\Response
     */
    public function translate(Request $request, $code, $group = null)
    {
        //    $this->authorize('Languages Translate');

        $language = Language::where('code', $code)->firstOrFail();
        if ($request->input('search')) {
            $q = $request->input('search');
            $groups = collect([
                (object) ["group_langname" => "Search results"],
            ]);
            $translates = Translate::where([['lang_code', $language->code], ['key', 'like', '%' . $q . '%']])
                ->OrWhere([['lang_code', $language->code], ['value', 'like', '%' . $q . '%']])
                ->OrWhere([['lang_code', $language->code], ['group_langname', 'like', '%' . $q . '%']])
                ->orderbyDesc('id')
                ->get();
            $active = "Search results";
        } elseif ($request->input('filter')) {
            abort_if($request->input('filter') != 'missing', 404);
            $groups = collect([
                (object) ["group_langname" => "missing translations"],
            ]);
            $translates = Translate::where([['lang_code', $language->code], ['value', null]])->orderby('group_langname')->get();
            $active = "missing translations";
        } else {
            $groups = Translate::where('lang_code', $language->code)->select('group_langname')->groupBy('group_langname')->orderBy('id', 'ASC')->get();
            if ($group != null) {
                $group = str_replace('-', ' ', $group);
                $translates = Translate::where('lang_code', $language->code)->where('group_langname', $group)->get();
                abort_if($translates->count() < 1, 404);
                $active = $group;
            } else {
                $translates = Translate::where('lang_code', $language->code)->where('group_langname', 'general')->get();
                $active = "general";
            }
        }
        $translates_count = Translate::where('lang_code', $language->code)->where('value', null)->count();

        return view('admin.settings.language.translate', [
            'active' => $active,
            'translates' => $translates,
            'groups' => $groups,
            'language' => $language,
            'translates_count' => $translates_count,
        ]);
    }

    public function translateUpdate(Request $request, $id)
    {
        if ($request->values == null) {
            return back()->with('error', lang('Please select any data to translate', 'alerts'));
        }

        $language = Language::where('id', $id)->first();
        if ($language == null) {
            // toastr()->error(__('Something went wrong please try again'));
            return back();
        }
        foreach ($request->values as $id => $value) {
            $translation = Translate::where('id', $id)->first();
            if ($translation != null) {
                $translation->value = $value;
                $translation->save();
            }
        }
        // toastr()->success(__('Updated Successfully'));
        return back()->with('success', lang('Updated Successfully', 'alerts'));
    }

}