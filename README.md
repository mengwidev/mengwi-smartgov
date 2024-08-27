# Mengwi SmartGov

Mengwi SmartGov is a web application designed for government workers to manage links efficiently. The application includes a link shortener with custom URLs, QR code generation, and a CRUD interface to manage the links. Future features will include stock inventory tracking.

## Features

-   **Link Shortener**: Shorten long URLs with custom slugs.
-   **QR Code Generation**: Automatically generate and view/download QR codes for shortened links.
-   **Link Management**: View, edit, and delete shortened links.
-   **User Interface**: Clean and responsive design using Bootstrap.

## Technologies Used

-   **Backend**: PHP 8.3
-   **Framework**: Laravel
-   **Database**: MariaDB
-   **Frontend**: Bootstrap 5.3 and Tailwind CSS
-   **QR Code Generation**: `endroid/qr-code` library

## Installation

### Prerequisites

-   PHP 8.3 or higher
-   Composer
-   MariaDB
-   Apache server

### Steps

1. **Clone the Repository**

    ```bash
    git clone https://github.com/yourusername/mengwi-smartgov.git
    cd mengwi-smartgov
    ```

2. **Install Dependencies**

    ```bash
    composer install
    ```

3. **Setup Environment**

    ```bash
    Set Up Environment
    ```

4. **Generate Application Key**

    ```bash
    php artisan key:generate
    ```

5. **Run Migrations**

    ```bash
    php artisan migrate
    ```

## Usage

-   Shorten Link: Enter the original URL and a custom slug in the form on the homepage and submit.
-   Manage Links: View, edit, or delete existing links from the "Manage Links" section.
-   View QR Code: Click "QR Code" to view the generated QR code in a modal.
-   Download QR Code: Download the QR code image directly from the modal.

## Contributing

Contributions are welcome! Please follow these guidelines:

1. Fork the repository.
2. Create a feature branch (git checkout -b feature/YourFeature).
3. Commit your changes (git commit -am 'Add new feature').
4. Push to the branch (git push origin feature/YourFeature).
5. Open a pull request.

## Acknowledgements

-   Laravel for the powerful PHP framework.
-   Bootstrap for the responsive design.
-   Tailwind CSS for the beautiful UI.
-   Endroid QR Code for QR code generation.
