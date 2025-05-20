<div class="container">
    <h1 class="mb-4 text-2xl font-bold text-green-600">✅ Application Submitted Successfully!</h1>

    <div class="rounded bg-white p-6 shadow">
        <h2 class="text-lg font-semibold">Application Details</h2>
        <ul class="mt-2">
            <li><strong>Registration Number:</strong> {{ $application->reg_num }}</li>
            <li><strong>Status:</strong> {{ $application->applicationStatus->name }}</li>
            <li><strong>Method:</strong> {{ $application->applicationMethod->name }}</li>
            <li><strong>Requested Information:</strong> {{ $application->information_requested }}</li>
            <li><strong>Purpose:</strong> {{ $application->information_purposes }}</li>
        </ul>

        <h2 class="mt-6 text-lg font-semibold">Applicant Info</h2>
        <ul class="mt-2">
            <li><strong>Name:</strong> {{ $application->applicant->name }}</li>
            <li><strong>Email:</strong> {{ $application->applicant->email }}</li>
            <li><strong>Phone:</strong> {{ $application->applicant->phone }}</li>
        </ul>
    </div>

    <a href="#" class="mt-6 inline-block rounded bg-blue-500 px-4 py-2 text-white">Back to
        Applications</a>
</div>
