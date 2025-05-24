@extends('layouts.master')

@section('content')

    @component('components.dashboard-layout', [
        'title' => __('pages.events'),
        'link' => route('admin.events.create'),
    ])
        <div
            class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <div class="max-w-full overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-2 text-left dark:bg-meta-4">
                            <th class="min-w-[220px] py-4 px-4 font-medium text-right text-black dark:text-white xl:pl-11">
                                نام
                            </th>
                            <th class="min-w-[120px] py-4 px-4 font-medium text-right text-black dark:text-white">
                                شماره موبایل
                            </th>   
                            <th class="py-4 px-4 font-medium text-black  text-right dark:text-white">
                                پایه تحصیلی
                            </th>
                              <th class="min-w-[120px] py-4 px-4 font-medium text-right text-black dark:text-white">
                                شماره ضروری
                            </th>   
                            <th class="min-w-[150px] py-4 px-4 font-medium text-right text-black dark:text-white">
                                تاریخ ایجاد
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($rows->isNotEmpty())
                            @foreach ($rows as $row)
                                <tr>
                                    <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
                                        <p class="text-sm">{{ $row->nick_name }}</p>
                                    </td>
                                    <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
                                        <p class="text-sm">{{ $row->mobile }}</p>
                                    </td>
                                    <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
                                        <p class="text-sm">{{ __("pages.level_".$row->level) }}</p>
                                    </td>
                                    <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
                                        <p class="text-sm">{{ $row->alternative_mobile }}</p>
                                    </td>
                                    <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
                                        <p class="text-sm">{{ $row->created_at ?? '' }}</p>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                <div class="p-4 navigation">
                    {{ $rows->links() }}
                </div>

            </div>
        </div>
    @endcomponent

@endsection
