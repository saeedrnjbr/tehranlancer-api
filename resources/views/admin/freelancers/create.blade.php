@extends('layouts.master')

@section('content')
    @component('components.dashboard-layout', [
        'title' => __('pages.freelancers'),
    ])
        <div class="flex flex-col gap-9">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
               
                <form enctype="multipart/form-data" method="post" action="{{ !empty($edit) && $edit->id ? route("admin.freelancers.update", ["id" => $edit->id]) : route("admin.freelancers.store") }}" class="flex flex-col gap-5.5 p-6.5">
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
                            سن
                        </label>
                        <input value="{{ !empty($edit) &&  $edit->age ? $edit->age : @old("age") }}"  type="text" name="age" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                    </div>
                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            مهارت‌ها
                        </label>
                        <textarea name="skills" id="skills_editor"  class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ !empty($edit) &&  $edit->skills ? $edit->skills : @old("skills") }}</textarea>
                    </div>
                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            سوابق‌کاری
                        </label>
                        <textarea name="about" id="about_editor" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ !empty($edit) &&  $edit->about ? $edit->about : @old("about") }}</textarea>
                    </div>
                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            علاقمندی‌ها
                        </label>
                        <textarea name="favorites" id="favorites_editor" class="w-full  rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ !empty($edit) &&  $edit->favorites ? $edit->favorites : @old("favorites") }}</textarea>
                    </div>
                    <div>
                        <label
                          class="mb-3 block text-sm font-medium text-black dark:text-white"
                        >
                          تصویر کاربری
                        </label>
                        <div class="flex gap-5 items-center justify-between">
                            <input
                            type="file" name="image"
                            class="w-full cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent font-medium outline-none transition file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:py-3 file:px-5 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary"
                            />
                            @if (!empty($edit->avatar))
                                <div class="relative">
                                    <img src="/uploads/{{ $edit->avatar }}" class="w-32">
                                    <a href="{{ route("admin.freelancers.remove.image", ["id" => $edit->id ]) }}">
                                        <svg class="absolute -left-3 -top-4 cursor-pointer w-6" viewBox="0 0 24 24" id="magicoon-Filled" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> <style>.cls-1{fill:#fe6c6c;}</style> </defs> <title>times-square</title> <g id="times-square-Filled"> <path id="times-square-Filled-2" data-name="times-square-Filled" class="cls-1" d="M15,2.5H9A6.513,6.513,0,0,0,2.5,9v6A6.513,6.513,0,0,0,9,21.5h6A6.513,6.513,0,0,0,21.5,15V9A6.513,6.513,0,0,0,15,2.5Zm.71,11.79a1.008,1.008,0,0,1,0,1.42,1.014,1.014,0,0,1-1.42,0L12,13.42,9.71,15.71a1.014,1.014,0,0,1-1.42,0,1.008,1.008,0,0,1,0-1.42L10.58,12,8.29,9.71A1,1,0,0,1,9.71,8.29L12,10.58l2.29-2.29a1,1,0,0,1,1.42,1.42L13.42,12Z"></path> </g> </g></svg>
                                    </a>
                                </div>
                            @endif
                        </div>
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
