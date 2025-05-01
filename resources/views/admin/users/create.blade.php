@extends('layouts.master')

@section('content')
    @component('components.dashboard-layout', [
        'title' => __('pages.users'),
    ])
        <div class="flex flex-col gap-9">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <form method="post" action="{{ !empty($edit) && $edit->id ? route("admin.users.update", ["id" => $edit->id]) : route("admin.users.store") }}" class="flex flex-col gap-5.5 p-6.5">
                    @include("partials.errors")
                    @csrf
                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            نام
                        </label>
                        <input value="{{ !empty($edit) && $edit->first_name ? $edit->first_name : @old("first_name") }}"  type="text" name="first_name" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                    </div>
                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            نام خانوادگی
                        </label>
                        <input value="{{ !empty($edit) &&  $edit->last_name ? $edit->last_name : @old("last_name") }}"  type="text" name="last_name" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                    </div>
                    
                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            نوع
                        </label>
                        <select name="user_type"
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
                      >
                        <option value="">انتخاب کنید</option>
                        <option @if(!empty($edit) && $edit->user_type == "admin") selected @endif value="admin">مدیر</option>
                        <option @if(!empty($edit) && $edit->user_type == "user") selected @endif  value="user">کاربر معمولی</option>
                      </select>
                    </div>
                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            تلفن همراه
                        </label>
                        <input value="{{ !empty($edit) && $edit->mobile ? $edit->mobile : @old("mobile") }}" value="{{ @old("mobile") }}" type="text" name="mobile" 
                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                    </div>
                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            رمزعبور
                        </label>
                        <input  type="password" name="password" 
                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                    </div>
                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            وضعیت
                        </label>
                        <select name="is_active"
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
                      >
                        <option value="">انتخاب کنید</option>
                        <option @if(!empty($edit) && $edit->is_active == "1") selected @endif value="1">فعال</option>
                        <option @if(!empty($edit) && $edit->is_active == "0") selected @endif value="0">غیرفعال</option>
                      </select>
                    </div>
                    <div>
                        <input type="submit" value="ثبت"
                            class="w-full cursor-pointer text-lg rounded-lg border text-white bg-success p-4 font-medium transition hover:bg-opacity-90" />
                    </div>
                </form>
            </div>
        </div>
    @endcomponent
@endsection
