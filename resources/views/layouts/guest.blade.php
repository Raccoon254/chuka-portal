<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <!-- Dark Mode Switch -->
            <label class="swap swap-rotate mx-3">
                <!-- this hidden checkbox controls the state -->
                <input class="" id="theme-switch" type="checkbox" />
                <!-- sun icon -->
                <svg class="swap-on fill-white w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="#ffff" d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z"/></svg>

                <!-- moon icon -->
                <svg class="swap-off fill-current w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z"/></svg>
            </label>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>


        <script>

            document.addEventListener('DOMContentLoaded', function () {
                const el = document.querySelector('.swap');
                let isDown = false;
                let offsetX, offsetY;

                el.addEventListener('mousedown', (e) => {
                    isDown = true;
                    offsetX = e.clientX - el.getBoundingClientRect().left;
                    offsetY = e.clientY - el.getBoundingClientRect().top;
                });

                window.addEventListener('mousemove', (e) => {
                    if (!isDown) return;

                    const x = e.clientX - offsetX;
                    const y = e.clientY - offsetY;

                    el.style.left = `${x}px`;
                    el.style.top = `${y}px`;
                });

                window.addEventListener('mouseup', () => {
                    if (!isDown) return;
                    isDown = false;

                    // Snap to nearest edge
                    const bounds = el.getBoundingClientRect();

                    if (bounds.left < window.innerWidth / 2) {
                        el.style.left = '10px';
                    } else {
                        el.style.left = `${window.innerWidth - bounds.width - 10}px`;
                    }

                    if (bounds.top < window.innerHeight / 2) {
                        el.style.top = '10px';
                    } else {
                        el.style.top = `${window.innerHeight - bounds.height - 10}px`;
                    }
                });
            });

            const fetchUrl = "{{ route('get-theme') }}"
            const setUrl = "{{ route('set-theme') }}"
            // Function to set the theme in session

            const setThemeInSession = (theme) => {
                fetch(setUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ theme }),
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to set theme in session.');
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            };

            // Function to get the theme from session
            const getThemeFromSession = () => {
                return fetch(fetchUrl, {
                    method: 'GET',
                })
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        } else {
                            throw new Error('Failed to get theme from session.');
                        }
                    })
                    .then(data => {
                        return data.theme;
                    })
                    .catch(error => {
                        console.error(error);
                        return 'light'; // Default to light theme if there's an error
                    });
            };

            // Function to apply the saved theme
            const applySavedTheme = () => {
                getThemeFromSession().then(savedTheme => {
                    const html = document.querySelector('html');
                    const themeSwitch = document.querySelector('#theme-switch');

                    html.setAttribute('data-theme', savedTheme);

                    themeSwitch.checked = savedTheme === 'dark';
                    /*
                    if (savedTheme === 'dark') {
                        themeSwitch.checked = true; // Check the switch
                    } else {
                        themeSwitch.checked = false; // Uncheck the switch
                    }
                    */
                });
            };

            // Get the theme switch checkbox
            const themeSwitch = document.querySelector('#theme-switch');

            // Add a change event listener to the theme switch
            themeSwitch.addEventListener('change', () => {
                const html = document.querySelector('html');

                if (themeSwitch.checked) {
                    // If the switch is checked (dark mode)
                    html.setAttribute('data-theme', 'dark');
                    setThemeInSession('dark'); // Save the theme in session
                } else {
                    // If the switch is not checked (light mode)
                    html.setAttribute('data-theme', 'light');
                    setThemeInSession('light'); // Save the theme in session
                }
            });

            // Apply the saved theme when the page loads
            window.addEventListener('load', () => {
                applySavedTheme();
            });
        </script>
    </body>
</html>
