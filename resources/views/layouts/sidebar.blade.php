<div class="drawer sticky h-full lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle lg:hidden"/>
    <div class="drawer-side z-40 lg:block">
        <label for="my-drawer" class="drawer-overlay lg:hidden"></label>
        <section
            class="menu p-4 flex flex-col z-30 gap-4 mt-16 sm:mt-0 w-56 h-full bg-base-200 text-base-content lg:block">
            <a href="{{ route('dashboard') }}" class="sidebar-item {{ Route::is('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-user-circle"></i>
                User Profile
            </a>

            <header class="text-[15px] py-[10px] px-[16px] mx-[16px]">
                ACADEMICS
            </header>

            <!-- Sidebar content here -->
            <a href="" class="sidebar-item {{ Route::is('account.index') ? 'active' : '' }}">
                <i class="fa-solid fa-registered"></i>
                Course Registration
            </a>

            <a href="" class="sidebar-item {{ Route::is('user.withdrawals') ? 'active' : '' }}">
                <i class="fa-solid fa-clock"></i>
                Timetable
            </a>

            <a href="" class="sidebar-item {{ Route::is('notifications.user') ? 'active' : '' }}">
                <i class="fa-solid fa-bell"></i>
                Academic Requisition
            </a>

            <a class="sidebar-item">
                <i class="fa-solid fa-crosshairs"></i>
                Course Evaluation
            </a>

            <header class="text-[15px] py-[10px] px-[16px] mx-[16px]">
                FINANCE
            </header>

            <a class="sidebar-item">
                <i class="fa-solid fa-money-bill"></i>
                Fees Statements
            </a>

            <a class="sidebar-item">
                <i class="fa-solid fa-money-bill"></i>
                Legacy Statements
            </a>

            <a class="sidebar-item">
                <i class="fa-solid fa-money-bill"></i>
                Receipts
            </a>

            <a class="sidebar-item">
                <i class="fa-solid fa-money-bill"></i>
                Payment History
            </a>
            
            <header class="text-[15px] py-[10px] px-[16px] mx-[16px]">
                ACCOMMODATION
            </header>

            <a class="sidebar-item">
                <i class="fa-solid fa-home"></i>
                Hostel Booking
            </a>

            <header class="text-[15px] py-[10px] px-[16px] mx-[16px]">
                EXAMINATION
            </header>

            <a class="sidebar-item">
                <i class="fa-solid fa-clipboard-list"></i>
                Transcript
            </a>

            <header class="text-[15px] py-[10px] px-[16px] mx-[16px]">
                SETTINGS
            </header>

            <a class="sidebar-item">
                <i class="fa-solid fa-cog"></i>
                Change Password
            </a>

            <a class="sidebar-item">
                <i class="fa-solid fa-sign-out"></i>
                Logout
            </a>

            <a class="sidebar-item">
                <i class="fa-solid fa-info-circle"></i>
                Help
            </a>

        </section>

    </div>
</div>
