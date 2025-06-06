@extends('layouts.master')

@section('content')
    @component('components.dashboard-layout', [
        'title' => __('pages.courses'),
    ])
        <div class="flex flex-col gap-9">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">

                <form enctype="multipart/form-data" method="post"
                    action="{{ !empty($edit) && $edit->id ? route('admin.courses.update', ['id' => $edit->id]) : route('admin.courses.store') }}"
                    class="flex flex-col gap-5.5 p-6.5">
                    @include('partials.errors')
                    @csrf
                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            نام
                        </label>
                        <input value="{{ !empty($edit) && $edit->name ? $edit->name : @old('name') }}" type="text"
                            name="name"
                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                    </div>

                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            دسته‌بندی دروه
                        </label>
                        <select name="course_category_id"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                            @foreach ($categories as $category)
                                <option @if (!empty($edit) && $edit->course_category_id == $category->id) selected @endif value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            مقطع
                        </label>
                        <select name="level"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                            <option value="1" @if (!empty($edit) && $edit->level == 1) selected @endif>پایه اول</option>
                            <option value="2" @if (!empty($edit) && $edit->level == 2) selected @endif>پایه دوم</option>
                            <option value="3" @if (!empty($edit) && $edit->level == 3) selected @endif>پایه سوم</option>
                            <option value="4" @if (!empty($edit) && $edit->level == 4) selected @endif>پایه چهارم</option>
                            <option value="5" @if (!empty($edit) && $edit->level == 5) selected @endif>پایه پنجم</option>
                            <option value="6" @if (!empty($edit) && $edit->level == 6) selected @endif>پایه ششم</option>
                            <option value="7" @if (!empty($edit) && $edit->level == 7) selected @endif>پایه هفتم</option>
                            <option value="8" @if (!empty($edit) && $edit->level == 8) selected @endif>پایه هشتم</option>
                            <option value="9" @if (!empty($edit) && $edit->level == 9) selected @endif>پایه نهم</option>
                            <option value="10" @if (!empty($edit) && $edit->level == 10) selected @endif>پایه دهم</option>
                            <option value="11" @if (!empty($edit) && $edit->level ==11) selected @endif>پایه یازدهم</option>
                            <option value="12" @if (!empty($edit) && $edit->level == 12) selected @endif>پایه دوازدهم</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            معرفی
                        </label>
                        <textarea name="content"
                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ !empty($edit) && $edit->content ? $edit->content : @old('content') }}</textarea>
                    </div>
                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            توضیحات کامل
                        </label>
                        <textarea name="description" id="about_editor"
                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ !empty($edit) && $edit->description ? $edit->description : @old('description') }}</textarea>
                    </div>
                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            تصویر محصول
                        </label>
                        <div class="flex gap-5 items-center justify-between">
                            <input type="file" name="image"
                                class="w-full cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent font-medium outline-none transition file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:py-3 file:px-5 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary" />
                            @if (!empty($edit->image))
                                <div class="relative">
                                    <img src="/uploads/{{ $edit->image }}" class="w-32">
                                    <a href="{{ route('admin.courses.remove.image', ['id' => $edit->id]) }}">
                                        <svg class="absolute -left-3 -top-4 cursor-pointer w-6" viewBox="0 0 24 24"
                                            id="magicoon-Filled" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <defs>
                                                    <style>
                                                        .cls-1 {
                                                            fill: #fe6c6c;
                                                        }
                                                    </style>
                                                </defs>
                                                <title>times-square</title>
                                                <g id="times-square-Filled">
                                                    <path id="times-square-Filled-2" data-name="times-square-Filled"
                                                        class="cls-1"
                                                        d="M15,2.5H9A6.513,6.513,0,0,0,2.5,9v6A6.513,6.513,0,0,0,9,21.5h6A6.513,6.513,0,0,0,21.5,15V9A6.513,6.513,0,0,0,15,2.5Zm.71,11.79a1.008,1.008,0,0,1,0,1.42,1.014,1.014,0,0,1-1.42,0L12,13.42,9.71,15.71a1.014,1.014,0,0,1-1.42,0,1.008,1.008,0,0,1,0-1.42L10.58,12,8.29,9.71A1,1,0,0,1,9.71,8.29L12,10.58l2.29-2.29a1,1,0,0,1,1.42,1.42L13.42,12Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
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
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                            <option value="">انتخاب کنید</option>
                            <option @if (!empty($edit) && $edit->is_active == '1') selected @endif value="1">فعال</option>
                            <option @if (!empty($edit) && $edit->is_active == '0') selected @endif value="0">غیرفعال</option>
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
