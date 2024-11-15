<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        #sidebar {
            width: 250px;
            height: 100vh;
            background-color: #007bff
; 
            transition: width 0.3s ease, left 0.3s ease;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            overflow: hidden;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
        }

        #sidebar.collapsed {
            width: 80px;
        }

        #sidebar.hidden-mobile {
            left: -250px;
        }

        #sidebar .nav-link {
            color: #f8f9fa;
            padding: 15px 10px;
            font-size: 1rem;
            display: flex;
            align-items: center;
            transition: background 0.3s, color 0.3s;
        }

        #sidebar .nav-link i {
            margin-right: 15px;
            transition: transform 0.3s, color 0.3s;
        }

        #sidebar .nav-link:hover {
            background-color: #0bb2d4;
            color: #ffffff;
        }

        #sidebar.collapsed .nav-link i {
            margin: 0;
            transform: scale(1.2);
        }

        #sidebar.collapsed .nav-link span {
            display: none;
        }
        #content {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            padding: 20px;
            margin-top: 60px;
            background-color: #ffffff;
            min-height: 100vh;
        }

        #content.full-width {
            margin-left: 80px;
        }

        #header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 60px;
            background-color: #007bff
            ;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            z-index: 101;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        #header .navbar-brand {
            color: #ffffff;
            font-size: 1.4rem;
            font-weight: bold;
        }

        #header .navbar-brand:hover {
            color: #0bb2d4;
        }
        #toggleSidebar {
            background-color: transparent;
            color: #ffffff;
            border: none;
            font-size: 1.4rem;
            padding: 8px;
            cursor: pointer;
            position: relative;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #toggleSidebar .line {
            position: absolute;
            width: 20px;
            height: 2px;
            background-color: #fff;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        #toggleSidebar .line1 {
            top: 7px;
        }

        #toggleSidebar .line2 {
            top: 14px;
        }
        #toggleSidebar.toggle .line1 {
            transform: rotate(45deg);
            top: 14px;
        }

        #toggleSidebar.toggle .line2 {
            transform: rotate(-45deg);
            top: 14px;
        }

        @media (max-width: 768px) {
            #sidebar {
                left: -250px; 
            }

            #sidebar.show {
                left: 0;
            }

            #content {
                margin-left: 0;
            }
        }

.collapse {
    transition: max-height 0.3s ease-in-out;
    max-height: 0;
    overflow: hidden;
}

.collapse.show {
    max-height: 500px; 
}
    </style>
</head>
<body>