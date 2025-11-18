# Database Management Website

A simple PHP website to view and insert data into an Azure SQL Database.

## Setup Instructions

### 1. Database Setup

Before using this website, you need to:

1. **Update the password** in `config.php`:
   - Replace `{your_password_here}` with your actual database password

2. **Create the contacts table** in your Azure SQL Database:
   ```sql
   CREATE TABLE contacts (
       id INT IDENTITY(1,1) PRIMARY KEY,
       name NVARCHAR(100) NOT NULL,
       email NVARCHAR(100) NOT NULL,
       message NVARCHAR(MAX),
       created_at DATETIME DEFAULT GETDATE()
   );
   ```

### 2. Azure Web App Configuration

1. **Enable SQL Server Extension**:
   - In Azure Portal, go to your Web App
   - Navigate to Configuration → General settings
   - Enable "Always On" if not already enabled

2. **Install SQL Server Drivers**:
   - The Azure Web App should have SQL Server drivers pre-installed
   - If not, you may need to add an extension or use Composer

3. **Deploy Files**:
   - Upload all files (config.php, index.php, style.css) to your Azure Web App
   - Ensure PHP version is 7.4 or higher

### 3. Security Notes

- **Important**: Update the password in `config.php` before deploying
- Consider using Azure Key Vault for storing credentials in production
- Enable HTTPS on your Azure Web App
- Consider adding input validation and prepared statements (already implemented)

## Features

- ✅ View all records from the database
- ✅ Insert new records via form
- ✅ Modern, responsive design
- ✅ Error handling and success messages
- ✅ Mobile-friendly interface

## File Structure

```
├── config.php      # Database connection configuration
├── index.php       # Main page with form and data display
├── style.css       # Styling for the website
└── README.md       # This file
```

## Customization

To use a different table structure, modify:
- The table name in `index.php` (currently "contacts")
- The column names in the INSERT and SELECT queries
- The form fields to match your table structure

