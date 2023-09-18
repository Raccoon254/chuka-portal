<!DOCTYPE html>
<html data-theme="{{ session('theme', 'light') }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')
<body class="font-sans text-gray-900 antialiased">
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

    <div>
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
        </a>
    </div>

    <!--Session Alerts-->
    @include('session.alerts')

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
            body: JSON.stringify({theme}),
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
