# GSM Digital Repository

GSM Digital Repository is a simple web application that allows users to upload documents to a digital repository. This README file provides an overview of the project and instructions on how to use it.

## Features

- User authentication: Users need to log in before they can upload documents.
- File upload: Users can upload documents to the repository.
- Responsive design: The web application is designed to work on various devices.

## Tech Stack

- **Frontend**: HTML, CSS, JavaScript, Bootstrap
- **Backend**: PHP
- **Database**: MySQL

## demo-link: https://sakshiselmokar.github.io/GSM-Digital-Repository/  

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP installed on your server
- A web server (e.g., Apache) configured to run PHP scripts
- Write permissions for the `uploads` directory to store uploaded files

## Installation

1. Clone the repository to your local machine or server:

```
git clone <repository-url>
```

2. Configure your web server to serve the project directory.

3. Create a MySQL database and import the `database.sql` file to set up the necessary tables.

4. Update the database connection details in the `db_connection.php` file.

## Usage

1. Access the web application using a web browser.

2. Log in using your credentials. If you don't have an account, sign up.

3. Once logged in, you'll be able to see the option to upload files. Click on "Browse Files to Upload" or drag and drop files into the designated area.

4. Click on the "Upload Files" button to upload the selected files.

5. You'll receive a confirmation message if the upload is successful.

6. To view the uploaded files, click on "View Uploaded Data" in the navigation bar.

7. To log out, click on the "Logout" button.

## Contributing

Contributions are welcome! If you'd like to contribute to this project, please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/new-feature`).
3. Make your changes and commit them (`git commit -am 'Add new feature'`).
4. Push to the branch (`git push origin feature/new-feature`).
5. Create a new Pull Request.
