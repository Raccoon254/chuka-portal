<!DOCTYPE html>
<html data-theme="{{ session('theme', 'dark') }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <!-- Page Content -->

            <main>
                {{ $slot }}
            </main>


            <script>

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
                            return 'dark';
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
        </div>
    </body>
</html>
