<template>
    <div class="bg-white">
        <div class="relative isolate px-6 pt-6 lg:px-8">
            <!-- Background Gradient -->
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                 aria-hidden="true">
                <div
                    class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"/>
            </div>

            <!-- About Section -->
            <div class="mx-auto max-w-3xl py-16 lg:py-20 text-center">
                <h1 class="text-5xl font-semibold tracking-tight text-gray-900 sm:text-6xl">About this project</h1>
                <p class="mt-6 text-lg text-gray-600">
                    This project is a test assignment for the Back-end Developer (PHP, Laravel) position.
                    It demonstrates the implementation of a REST API server with a minimal frontend to showcase the API's functionality.
                </p>
            </div>

            <!-- Features Section -->
            <div class="mx-auto max-w-3xl py-8 lg:py-12">
                <h2 class="text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl">Features</h2>
                <ul class="mt-6 space-y-4 text-left text-gray-600">
                    <li>
                        <strong>REST API:</strong> Built according to the
                        <a href="https://drive.google.com/file/d/1d5sXqu24Toe0AL2lzS1qg18lGQwmbsCb/view" target="_blank" class="text-blue-600 underline hover:text-blue-500">Technical Assignment</a>
                        and
                        <a href="https://openapi_apidocs.abz.dev/frontend-test-assignment-v1/" target="_blank" class="text-blue-600 underline hover:text-blue-500">API Documentation</a>.
                    </li>
                    <li><strong>Token-based Authorization:</strong> Secures access to protected endpoints.</li>
                    <li><strong>Data Management:</strong> Includes seeders to populate the database with realistic user data.</li>
                    <li><strong>Image Processing:</strong>
                        <ul class="mt-2 pl-6 list-disc">
                            <li>Crops user photos to 70x70px (center/center).</li>
                            <li>Optimizes images using the Tinify API.</li>
                        </ul>
                    </li>
                    <li><strong>Frontend:</strong>
                        <ul class="mt-2 pl-6 list-disc">
                            <li>Displays a paginated user list (6 users per page).</li>
                            <li>Provides a form to add new users with server-side validation.</li>
                        </ul>
                    </li>
                </ul>
            </div>


            <!-- Technologies Section -->
            <div class="mx-auto max-w-3xl py-8 lg:py-12">
                <h2 class="text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl">Technologies Used</h2>
                <ul class="mt-6 space-y-2 text-left text-gray-600">
                    <li><strong>Backend:</strong> PHP 8.2, Laravel 11.9, MySQL 8.0</li>
                    <li><strong>Frontend:</strong> Vue 3.5</li>
                    <li><strong>Image Optimization:</strong> Tinify API</li>
                </ul>
            </div>

            <!-- Challenges Section -->
            <div class="mx-auto max-w-3xl py-8 lg:py-12">
                <h2 class="text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl">Challenges</h2>
                <ul class="mt-6 space-y-4 text-left text-gray-600">
                    <li>Streamlining Tinify API integration for efficient image processing.</li>
                    <li>Adhering strictly to OpenAPI specifications.</li>
                    <li>Delivering a functional frontend while focusing primarily on backend tasks.</li>
                </ul>
            </div>

            <!-- Call to Action -->
            <div class="mx-auto max-w-3xl py-8 lg:py-12">
                <h2 class="text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl">See the code on GitHub</h2>
                <p class="mt-4 text-lg text-gray-600">
                    Explore the project's source code, including API implementation, frontend integration, and more.
                </p>
                <a href="https://github.com/RomanNikolaevich/abz-agency-laravel-test-assignment-api" target="_blank"
                   class="mt-6 inline-block rounded-lg bg-blue-600 px-6 py-3 text-lg font-medium text-white shadow-lg hover:bg-blue-500">
                    Visit GitHub Repository
                </a>
            </div>
        </div>
    </div>
</template>
