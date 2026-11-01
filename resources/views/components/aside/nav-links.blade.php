<nav class="space-y-6 text-sm">
    {{-- EMPLOYEES SECTION --}}
    <div class="space-y-2">
        <p class="px-3 font-semibold text-gray-400 text-xs uppercase tracking-wider">Employees</p>

        <div class="space-y-1">
            {{-- INDEX / ALL EMPLOYEES --}}
            <a href="{{ route('employees.index') }}"
                class="{{ request()->routeIs('employees.index')
                    ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm'
                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }} 
                    group flex items-center gap-x-3 rounded-lg px-3 py-2.5 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="{{ request()->routeIs('employees.index') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-600' }} shrink-0 transition-colors">
                    <path d="M17 21v-1a2 2 0 00-2-2H9a2 2 0 00-2 2v1" />
                    <path d="M19 10h1a2 2 0 012 2v1" />
                    <path d="M5 10H4a2 2 0 00-2 2v1" />
                    <circle cx="12" cy="11" r="3" />
                    <circle cx="18" cy="4" r="2" />
                    <circle cx="6" cy="4" r="2" />
                </svg>
                <span>All Employees</span>
            </a>

            {{-- ADD / CREATE EMPLOYEE --}}
            <a href="{{ route('employees.create') }}"
                class="{{ request()->routeIs('employees.create')
                    ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm'
                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }} 
                    group flex items-center gap-x-3 rounded-lg px-3 py-2.5 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="{{ request()->routeIs('employees.create') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-600' }} shrink-0 transition-colors">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <line x1="19" x2="19" y1="8" y2="14" />
                    <line x1="22" x2="16" y1="11" y2="11" />
                </svg>
                <span>Add Employee</span>
            </a>
        </div>
    </div>
</nav>
