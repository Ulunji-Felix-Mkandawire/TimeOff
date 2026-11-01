<x-layout>
    <div class="flex justify-center items-center px-4 py-12 min-h-[80vh]">
        <div class="bg-white shadow-sm border border-gray-200 rounded-2xl w-full max-w-lg overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gray-50/50 px-8 py-6 border-gray-100 border-b">
                <h2 class="font-semibold text-gray-900 text-lg">Add New Employee</h2>
                <p class="mt-1 text-gray-500 text-xs">Enter the employee details below to add them to the system.</p>
            </div>

            <!-- Form Body -->
            <form class="space-y-5 p-8" method="POST" action="{{ route('employees.store') }}">
                @csrf

                <!-- Full Name -->
                <div>
                    <label for="name"
                        class="block mb-1.5 font-semibold text-gray-600 text-xs uppercase tracking-wider">Full
                        Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        placeholder="e.g. Krassic Felix"
                        class="shadow-sm px-3.5 py-2.5 border border-gray-300 focus:border-indigo-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500/20 w-full text-gray-900 placeholder:text-gray-400 text-sm transition" />
                    @error('name')
                        <p class="mt-1 text-red-600 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email"
                        class="block mb-1.5 font-semibold text-gray-600 text-xs uppercase tracking-wider">Email
                        Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        placeholder="krassic.felix@company.com"
                        class="shadow-sm px-3.5 py-2.5 border border-gray-300 focus:border-indigo-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500/20 w-full text-gray-900 placeholder:text-gray-400 text-sm transition" />
                    @error('email')
                        <p class="mt-1 text-red-600 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Department -->
                <div>
                    <label for="department_id"
                        class="block mb-1.5 font-semibold text-gray-600 text-xs uppercase tracking-wider">Department</label>
                    <select name="department_id" id="department_id"
                        class="bg-white shadow-sm px-3.5 py-2.5 border border-gray-300 focus:border-indigo-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500/20 w-full text-gray-900 text-sm transition cursor-pointer">
                        <option value="" disabled @selected(!old('department_id'))>Select department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" @selected(old('department_id') == $department->id)>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <p class="mt-1 text-red-600 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Manager -->
                <div>
                    <label for="manager_id"
                        class="block mb-1.5 font-semibold text-gray-600 text-xs uppercase tracking-wider">Manager <span
                            class="font-normal text-gray-400">(Optional)</span></label>
                    <select name="manager_id" id="manager_id"
                        class="bg-white shadow-sm px-3.5 py-2.5 border border-gray-300 focus:border-indigo-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500/20 w-full text-gray-900 text-sm transition cursor-pointer">
                        <option value="">No manager</option>
                        @foreach ($managers as $manager)
                            <option value="{{ $manager->id }}" @selected(old('manager_id') == $manager->id)>
                                {{ $manager->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('manager_id')
                        <p class="mt-1 text-red-600 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex justify-end items-center gap-3 pt-4 border-gray-100 border-t">
                    <button type="submit"
                        class="inline-flex justify-center bg-indigo-600 hover:bg-indigo-500 shadow-sm px-5 py-2.5 rounded-lg focus-visible:outline focus-visible:outline-indigo-600 focus-visible:outline-offset-2 w-full sm:w-auto font-semibold text-white text-sm transition">
                        Add Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
