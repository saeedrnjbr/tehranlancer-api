@extends('layouts.master')

@section('content')
    @component('components.dashboard-layout', [
        'title' => __('pages.lessons'),
    ])
        <div class="flex flex-col gap-9">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
               
                <form enctype="multipart/form-data" method="post" action="{{ !empty($edit) && $edit->id ? route("admin.lessons.update", ["id" => $edit->id]) : route("admin.lessons.store") }}" class="flex flex-col gap-5.5 p-6.5">
                    @include("partials.errors")
                    @csrf
                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            نام
                        </label>
                        <input value="{{ !empty($edit) && $edit->name ? $edit->name : @old("name") }}"  type="text" name="name" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                    </div>
                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            دوره 
                        </label>
                        <select name="course_id"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
                        >
                            @foreach ($courses as $course)
                            <option @if(!empty($edit) && $edit->course_id == $course->id) selected @endif value="{{  $course->id }}">{{  $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            مدت زمان 
                        </label>
                        <input value="{{ !empty($edit) && $edit->duration ? $edit->duration : @old("duration") }}"  type="text" name="duration" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                    </div>
                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            لینک ویدیو
                        </label>
                        <input value="{{ !empty($edit) && $edit->link ? $edit->link : @old("link") }}"  type="text" name="link" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
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
