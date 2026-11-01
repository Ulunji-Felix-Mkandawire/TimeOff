<x-layout>
    {{-- MESSEGES --}}
    @if (session('success'))
        <div class="px-32 py-2.5">
            <p class="text-green-500 text-sm">{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-gray-600 text-sm text-left">
                <thead
                    class="bg-gray-50/75 border-gray-200 border-b font-semibold text-gray-500 text-xs uppercase tracking-wider">
                    <tr>
                        <th scope="col" class="px-6 py-4">Employee</th>
                        <th scope="col" class="px-6 py-4">Email</th>
                        <th scope="col" class="px-6 py-4">Department</th>
                        <th scope="col" class="px-6 py-4">Manager</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($employees as $employee)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <!-- Employee Name -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex justify-center items-center bg-indigo-50 rounded-full w-9 h-9 font-semibold text-indigo-600">
                                        {{ strtoupper(substr($employee->name, 0, 1)) }}
                                    </div>
                                    <span class="font-medium text-gray-900">{{ $employee->name }}</span>
                                </div>
                            </td>

                            <!-- Email -->
                            <td class="px-6 py-4 text-gray-500 whitespace-nowrap">
                                {{ $employee->email }}
                            </td>

                            <!-- Department Badge -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center bg-slate-100 px-2.5 py-1 rounded-md font-medium text-slate-700 text-xs">
                                    {{ $employee->department->name }}
                                </span>
                            </td>

                            <!-- Manager -->
                            <td class="px-6 py-4 text-gray-500 whitespace-nowrap">
                                @if ($employee->manager)
                                    <span class="font-medium text-gray-700">{{ $employee->manager->name }}</span>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-gray-500 text-center">
                                <div class="flex flex-col justify-center items-center mx-auto max-w-xs">
                                    <svg class="mb-3 w-10 h-10 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                    <p class="font-semibold text-gray-900 text-base">No employees found</p>
                                    <p class="mt-1 text-gray-500 text-xs">Get started by adding your first team member.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $employees->links() }}
</x-layout>
