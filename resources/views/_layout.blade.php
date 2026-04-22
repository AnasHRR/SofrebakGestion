<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sofrebak')</title>
    <link rel="icon" type="image/png" href="{{ asset('logo_Sofrebak.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 290px;
            --sidebar-collapsed-width: 84px;
            --blue-900: #0a1740;
            --blue-800: #0e2266;
            --blue-700: #1e3a8a;
            --blue-600: #1d4ed8;
            --blue-500: #2563eb;
            --blue-400: #3b82f6;
            --blue-300: #60a5fa;
            --blue-100: #bfdbfe;
            --blue-50: #eff6ff;
            --sidebar-bg: #0b1735;
            --sidebar-text: rgba(255, 255, 255, 0.65);
            --sidebar-text-active: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f0f4ff;
            transition: all 0.3s ease;
        }
        
        body.sidebar-collapsed .sidebar {
            width: var(--sidebar-collapsed-width);
        }

        body.sidebar-collapsed .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* ── Collapsed Sidebar Elements ── */
        body.sidebar-collapsed .brand-name,
        body.sidebar-collapsed .brand-sub,
        body.sidebar-collapsed .nav-label-left span:last-child,
        body.sidebar-collapsed .nav-arrow,
        body.sidebar-collapsed .nav-submenu li a span,
        body.sidebar-collapsed .footer-info,
        body.sidebar-collapsed .footer-copy,
        body.sidebar-collapsed .nav-divider {
            display: none !important;
        }

        body.sidebar-collapsed .brand {
            padding: 1.6rem 0;
            display: flex;
            justify-content: center;
        }

        body.sidebar-collapsed .nav-label-left {
            justify-content: center;
            width: 100%;
        }

        body.sidebar-collapsed .nav-label-line {
            width: 24px;
        }

        body.sidebar-collapsed .nav-submenu li a {
            justify-content: center;
            padding: 0.6rem 0;
        }

        body.sidebar-collapsed .nav-submenu li a::after {
            display: none !important;
        }

        body.sidebar-collapsed .nav-links {
            padding: 0.4rem;
        }

        body.sidebar-collapsed .footer-card {
            padding: 0.8rem 0;
            background: transparent;
            border: none;
        }

        body.sidebar-collapsed .footer-user {
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }

        /* ═══════════════════════════════
           SIDEBAR
        ═══════════════════════════════ */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Top gradient line */
        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--blue-400), var(--blue-600), var(--blue-400));
            background-size: 200% 100%;
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: 0% 0%;
            }

            100% {
                background-position: 200% 0%;
            }
        }

        /* ── Brand ── */
        .brand {
            padding: 1.6rem 1.4rem 1.2rem;
        }

        .brand a {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            text-decoration: none;
        }

        .brand-logo {
            width: 46px;
            height: 46px;
            background: linear-gradient(135deg, var(--blue-800), var(--blue-900));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(10, 23, 64, 0.4);
            flex-shrink: 0;
        }

        .brand-logo i {
            color: #fff;
            font-size: 1.4rem;
        }

        .brand-name {
            font-size: 1.2rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.5px;
            line-height: 1;
        }

        .brand-sub {
            font-size: 0.6rem;
            color: var(--blue-300);
            font-weight: 600;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            margin-top: 3px;
        }

        /* ── Search ── */
        .sidebar-search {
            padding: 0 1.2rem 1rem;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            background: rgba(255, 255, 255, 0.07);
            border: 1.5px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 0.55rem 0.9rem;
            transition: all 0.3s ease;
        }

        .search-box:focus-within {
            border-color: var(--blue-400);
            background: rgba(255, 255, 255, 0.12);
            box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.15);
        }

        .search-box i {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.85rem;
        }

        .search-box input {
            border: none;
            outline: none;
            background: transparent;
            font-family: inherit;
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.8);
            width: 100%;
            font-weight: 500;
        }

        .search-box input::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .search-shortcut {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 6px;
            padding: 1px 7px;
            font-size: 0.58rem;
            color: rgba(255, 255, 255, 0.4);
            font-weight: 700;
            white-space: nowrap;
        }

        /* ── Nav Container ── */
        .nav-links {
            flex: 1;
            padding: 0.4rem 1rem;
            list-style: none;
            overflow-y: auto;
            scrollbar-width: none;
        }

        .nav-links::-webkit-scrollbar {
            display: none;
        }

        /* ── Section ── */
        .nav-section {
            list-style: none;
            margin-bottom: 0.5rem;
        }

        .nav-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.5rem 0.6rem;
            cursor: pointer;
            user-select: none;
            border-radius: 10px;
            transition: all 0.2s ease;
            margin-bottom: 0.25rem;
        }

        .nav-label:hover {
            background: rgba(255, 255, 255, 0.06);
        }

        .nav-label-left {
            display: flex;
            align-items: center;
            gap: 0.55rem;
        }

        .nav-label-line {
            width: 18px;
            height: 2px;
            background: linear-gradient(90deg, var(--blue-400), var(--blue-300));
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .nav-label.collapsed .nav-label-line {
            width: 10px;
            background: rgba(255, 255, 255, 0.2);
        }

        .nav-label-left span:last-child {
            font-size: 0.64rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255, 255, 255, 0.35);
            transition: color 0.2s ease;
        }

        .nav-label:hover .nav-label-left span:last-child {
            color: rgba(255, 255, 255, 0.6);
        }

        .nav-arrow {
            font-size: 0.5rem;
            color: rgba(255, 255, 255, 0.25);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), color 0.2s ease;
        }

        .nav-label:hover .nav-arrow {
            color: rgba(255, 255, 255, 0.5);
        }

        .nav-label.collapsed .nav-arrow {
            transform: rotate(-90deg);
        }

        /* ── Submenu ── */
        .nav-submenu {
            list-style: none;
            padding: 0;
            margin: 0;
            overflow: hidden;
            max-height: 500px;
            opacity: 1;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.25s ease;
        }

        .nav-submenu.hide {
            max-height: 0;
            opacity: 0;
            pointer-events: none;
        }

        .nav-submenu li {
            margin-bottom: 2px;
        }

        .nav-submenu li a {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.5rem 0.6rem;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .nav-submenu li a span {
            font-size: 0.86rem;
            font-weight: 500;
            color: var(--sidebar-text);
            transition: color 0.2s ease;
        }

        /* Icon Box */
        .nav-icon-box {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: rgba(255, 255, 255, 0.07);
            transition: all 0.25s ease;
            flex-shrink: 0;
        }

        .nav-icon-box i {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.45);
            transition: color 0.2s ease;
        }

        /* Hover */
        .nav-submenu li a:hover {
            background: rgba(255, 255, 255, 0.07);
        }

        .nav-submenu li a:hover .nav-icon-box {
            background: rgba(96, 165, 250, 0.2);
        }

        .nav-submenu li a:hover .nav-icon-box i {
            color: var(--blue-300);
        }

        .nav-submenu li a:hover span {
            color: #fff;
        }

        /* Active */
        .nav-submenu li a.active {
            background: linear-gradient(135deg, var(--blue-600), var(--blue-800));
            box-shadow: 0 6px 20px rgba(29, 78, 216, 0.45), 0 2px 6px rgba(29, 78, 216, 0.25);
        }

        .nav-submenu li a.active .nav-icon-box {
            background: rgba(255, 255, 255, 0.18);
        }

        .nav-submenu li a.active .nav-icon-box i {
            color: #ffffff;
        }

        .nav-submenu li a.active span {
            color: #ffffff;
            font-weight: 600;
        }

        .nav-submenu li a.active::after {
            content: '';
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 6px;
            height: 6px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            animation: activePulse 2s ease-in-out infinite;
        }

        @keyframes activePulse {

            0%,
            100% {
                opacity: 0.4;
                transform: translateY(-50%) scale(1);
            }

            50% {
                opacity: 1;
                transform: translateY(-50%) scale(1.4);
            }
        }

        /* ── Divider ── */
        .nav-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            margin: 0.5rem 0.6rem;
        }

        /* ── Sidebar Footer ── */
        .sidebar-footer {
            padding: 1rem 1.2rem 1.2rem;
        }

        .footer-card {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            padding: 0.85rem;
            margin-bottom: 0.8rem;
        }

        .footer-user {
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }

        .footer-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(29, 78, 216, 0.4);
        }

        .footer-avatar i {
            color: #fff;
            font-size: 1.1rem;
        }

        .footer-info {
            flex: 1;
            min-width: 0;
        }

        .footer-name {
            display: block;
            font-size: 0.85rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
        }

        .footer-role {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            margin-top: 3px;
        }

        .footer-role-dot {
            width: 5px;
            height: 5px;
            background: #4ade80;
            border-radius: 50%;
            box-shadow: 0 0 6px rgba(74, 222, 128, 0.5);
        }

        .footer-role span {
            font-size: 0.68rem;
            color: rgba(255, 255, 255, 0.4);
            font-weight: 500;
        }

        .footer-logout {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            color: rgba(255, 255, 255, 0.35);
            text-decoration: none;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .footer-logout:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
        }

        .footer-copy {
            text-align: center;
            font-size: 0.6rem;
            color: rgba(255, 255, 255, 0.2);
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* ═══════════════════════════════
           MAIN CONTENT
        ═══════════════════════════════ */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            background: #f0f4ff;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ── Top Bar ── */
        .top-bar {
            background: #ffffff;
            padding: 0.9rem 1.8rem;
            border-bottom: 1px solid #e2eaf8;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 4px rgba(15, 42, 110, 0.06);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .top-bar-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: #eff6ff;
            color: var(--blue-700);
            border: 1px solid var(--blue-100);
            border-radius: 8px;
            padding: 0.3rem 0.7rem;
            font-size: 0.72rem;
            font-weight: 700;
        }

        .top-bar-badge i {
            font-size: 0.75rem;
        }

        .top-bar h5 {
            margin: 0;
            font-weight: 800;
            color: #0f1e4a;
            font-size: 1.05rem;
            letter-spacing: -0.3px;
        }

        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .top-bar-btn {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            color: #64748b;
            background: #f8fafc;
            border: 1px solid #e8edf5;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            font-size: 1rem;
        }

        .top-bar-btn:hover {
            background: var(--blue-50);
            border-color: var(--blue-100);
            color: var(--blue-600);
        }

        .top-bar-divider {
            width: 1px;
            height: 24px;
            background: #e2eaf8;
            margin: 0 0.2rem;
        }

        .top-bar-user {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.3rem 0.7rem 0.3rem 0.4rem;
            border-radius: 10px;
            border: 1px solid #e2eaf8;
            background: #f8fafc;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .top-bar-user:hover {
            background: var(--blue-50);
            border-color: var(--blue-100);
        }

        .top-bar-avatar {
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .top-bar-avatar i {
            color: #fff;
            font-size: 0.85rem;
        }

        .top-bar-username {
            font-size: 0.8rem;
            font-weight: 700;
            color: #0f1e4a;
        }

        /* Page content wrapper */
        .page-content {
            padding: 1.5rem;
        }

        /* ═══════════════════════════════
           ADMIN DROPDOWN
        ═══════════════════════════════ */
        .admin-dropdown-wrapper {
            position: relative;
        }

        .admin-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 220px;
            background: #ffffff;
            border: 1px solid #e2eaf8;
            border-radius: 14px;
            box-shadow: 0 12px 40px rgba(15, 42, 110, 0.12), 0 4px 12px rgba(15, 42, 110, 0.06);
            padding: 0.5rem;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px) scale(0.97);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 200;
        }

        .admin-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .admin-dropdown::before {
            content: '';
            position: absolute;
            top: -6px;
            right: 16px;
            width: 12px;
            height: 12px;
            background: #ffffff;
            border-top: 1px solid #e2eaf8;
            border-left: 1px solid #e2eaf8;
            transform: rotate(45deg);
            border-radius: 2px;
        }

        .dropdown-header {
            padding: 0.6rem 0.7rem 0.5rem;
            border-bottom: 1px solid #f0f4ff;
            margin-bottom: 0.3rem;
        }

        .dropdown-header-name {
            font-size: 0.85rem;
            font-weight: 700;
            color: #0f1e4a;
            line-height: 1.2;
        }

        .dropdown-header-email {
            font-size: 0.7rem;
            color: #94a3b8;
            font-weight: 500;
            margin-top: 2px;
        }

        .dropdown-item-link {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.55rem 0.7rem;
            border-radius: 10px;
            text-decoration: none;
            color: #475569;
            font-size: 0.82rem;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            font-family: inherit;
        }

        .dropdown-item-link:hover {
            background: #f0f4ff;
            color: var(--blue-700);
        }

        .dropdown-item-link i {
            font-size: 1rem;
            width: 20px;
            text-align: center;
            color: #94a3b8;
            transition: color 0.2s ease;
        }

        .dropdown-item-link:hover i {
            color: var(--blue-500);
        }

        .dropdown-divider {
            height: 1px;
            background: #f0f4ff;
            margin: 0.3rem 0.5rem;
        }

        .dropdown-item-link.logout-link {
            color: #ef4444;
        }

        .dropdown-item-link.logout-link i {
            color: #fca5a5;
        }

        .dropdown-item-link.logout-link:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        .dropdown-item-link.logout-link:hover i {
            color: #ef4444;
        }

        /* ── Notifications ── */
        .notification-wrapper {
            position: relative;
        }

        .notification-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 320px;
            background: #ffffff;
            border: 1px solid #e2eaf8;
            border-radius: 14px;
            box-shadow: 0 12px 40px rgba(15, 42, 110, 0.12), 0 4px 12px rgba(15, 42, 110, 0.06);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px) scale(0.97);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 200;
        }

        .notification-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .notification-badge-icon {
            position: absolute;
            top: -2px;
            right: -2px;
            background: #ef4444;
            color: white;
            font-size: 0.6rem;
            font-weight: 800;
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 2px solid #ffffff;
        }

        .notification-header {
            padding: 0.8rem 1rem;
            border-bottom: 1px solid #f0f4ff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification-header span {
            font-weight: 700;
            color: #0f1e4a;
            font-size: 0.9rem;
        }

        .notification-header-badge {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            padding: 0.2rem 0.6rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .notification-list {
            max-height: 320px;
            overflow-y: auto;
        }

        .notification-item {
            padding: 0.8rem 1rem;
            border-bottom: 1px solid #f0f4ff;
            display: flex;
            gap: 0.8rem;
            text-decoration: none;
            transition: background 0.2s ease;
            position: relative;
        }

        .notification-item:hover {
            background: #f8fafc;
        }

        .notification-close-btn {
            background: none;
            border: none;
            color: #cbd5e1;
            font-size: 1.4rem;
            cursor: pointer;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: flex-start;
            transition: color 0.2s ease;
            line-height: 1;
        }

        .notification-close-btn:hover {
            color: #ef4444;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-icon {
            width: 36px;
            height: 36px;
            background: #fef2f2;
            color: #ef4444;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1rem;
        }

        .notification-title {
            font-size: 0.8rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.2rem;
        }

        .notification-desc {
            font-size: 0.75rem;
            color: #64748b;
            line-height: 1.3;
        }

        .notification-time {
            font-size: 0.68rem;
            color: #94a3b8;
            margin-top: 0.4rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .empty-notifications {
            padding: 2rem 1rem;
            text-align: center;
            color: #94a3b8;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .empty-notifications i {
            font-size: 1.8rem;
            color: #cbd5e1;
            display: block;
            margin-bottom: 0.5rem;
        }
        /* ── Custom Modal Overlay ── */
        .custom-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(11, 23, 53, 0.7);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .custom-modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .custom-modal-content {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transform: scale(0.9);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            text-align: center;
        }

        .custom-modal-overlay.active .custom-modal-content {
            transform: scale(1);
        }

        .custom-modal-header {
            margin-bottom: 1.5rem;
        }

        .custom-modal-icon {
            width: 64px;
            height: 64px;
            background: #fee2e2;
            color: #ef4444;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 1.2rem;
        }

        .custom-modal-header h4 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }

        .custom-modal-body p {
            font-size: 1rem;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .custom-modal-footer {
            display: flex;
            gap: 1rem;
        }

        .modal-btn {
            flex: 1;
            padding: 0.8rem;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-cancel {
            background: #f1f5f9;
            color: #475569;
        }

        .btn-cancel:hover {
            background: #e2e8f0;
            color: #1e293b;
        }

        .btn-confirm {
            background: #ef4444;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }

        .btn-confirm:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(239, 68, 68, 0.3);
        }
    </style>
</head>

<body>

    <!-- ════════ SIDEBAR ════════ -->
    <aside class="sidebar">
        <div class="brand">
            <a href="/">
                <div class="brand-logo">
                    <img src="{{ asset('logo_Sofrebak.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain;">
                </div>
                <div>
                    <div class="brand-name">Sofrebak</div>
                    <div class="brand-sub">Management</div>
                </div>
            </a>
        </div>

        <ul class="nav-links">
            <!-- ── Menu Principale ── -->
            <li class="nav-section">
                <div class="nav-label" onclick="toggleSection(this)">
                    <div class="nav-label-left">
                        <span class="nav-label-line"></span>
                        <span>Menu Principale</span>
                    </div>
                    <i class="bi bi-chevron-down nav-arrow"></i>
                </div>
                <ul class="nav-submenu">
                    <li>
                        <a href="/dashboard" class="{{ request()->is('dashboard*') ? 'active' : '' }}">
                            <div class="nav-icon-box"><i class="bi bi-grid-1x2-fill"></i></div>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/commandes" class="{{ (request()->is('commandes') || request()->is('commandes/*')) ? 'active' : '' }}">
                            <div class="nav-icon-box"><i class="bi bi-bag-plus-fill"></i></div>
                            <span>Commandes</span>
                        </a>
                    </li>
                    <li>
                        <a href="/expeditions" class="{{ (request()->is('expeditions') || request()->is('expeditions/*')) ? 'active' : '' }}">
                            <div class="nav-icon-box"><i class="bi bi-truck"></i></div>
                            <span>expeditions</span>
                        </a>
                    </li>
                    <li>
                        <a href="/paiements" class="{{ (request()->is('paiements') || request()->is('paiements/*')) ? 'active' : '' }}">
                            <div class="nav-icon-box"><i class="bi bi-cash"></i></div>
                            <span>paiements</span>
                        </a>
                    </li>
                    <li>
                        <a href="/stock" class="{{ request()->is('stock*') ? 'active' : '' }}">
                            <div class="nav-icon-box"><i class="bi bi-clipboard2-data-fill"></i></div>
                            <span>Stock</span>
                        </a>
                    </li>
                    <li>
                        <a href="/retours" class="{{ request()->is('retours*') ? 'active' : '' }}">
                            <div class="nav-icon-box"><i class="bi bi-arrow-return-left"></i></div>
                            <span>Retours</span>
                        </a>
                    </li>
                    <li>
                        <a href="/factures" class="{{ request()->is('factures*') ? 'active' : '' }}">
                            <div class="nav-icon-box"><i class="bi bi-receipt-cutoff"></i></div>
                            <span>Factures</span>
                        </a>
                    </li>
                </ul>
            </li>

            <div class="nav-divider"></div>

            <!-- ── Gestion ── -->
            <li class="nav-section">
                <div class="nav-label" onclick="toggleSection(this)">
                    <div class="nav-label-left">
                        <span class="nav-label-line"></span>
                        <span>Gestion</span>
                    </div>
                    <i class="bi bi-chevron-down nav-arrow"></i>
                </div>
                <ul class="nav-submenu">
                    <li>
                        <a href="/clients" class="{{ request()->is('clients*') ? 'active' : '' }}">
                            <div class="nav-icon-box"><i class="bi bi-people-fill"></i></div>
                            <span>Clients</span>
                        </a>
                    </li>
                    <li>
                        <a href="/produits" class="{{ request()->is('produits*') ? 'active' : '' }}">
                            <div class="nav-icon-box"><i class="bi bi-box-seam-fill"></i></div>
                            <span>Produits</span>
                        </a>
                    </li>
                    <li>
                        <a href="/fournisseurs" class="{{ request()->is('fournisseurs*') ? 'active' : '' }}">
                            <div class="nav-icon-box"><i class="bi bi-person-lines-fill"></i></div>
                            <span>Fournisseurs</span>
                        </a>
                    </li>
                    <li>
                        <a href="/commandes-fournisseurs" class="{{ request()->is('commandes-fournisseurs*') ? 'active' : '' }}">
                            <div class="nav-icon-box"><i class="bi bi-bag"></i></div>
                            <span>Commandes Fournisseurs</span>
                        </a>
                    </li>
                    <li>
                        <a href="/categories" class="{{ request()->is('categories*') ? 'active' : '' }}">
                            <div class="nav-icon-box"><i class="bi bi-filter-circle-fill"></i></div>
                            <span>Categories les produits</span>
                        </a>
                    </li>
                </ul>
            </li>

            <div class="nav-divider"></div>

            <!-- ── Paramètres ── -->
            <li class="nav-section">
                <div class="nav-label" onclick="toggleSection(this)">
                    <div class="nav-label-left">
                        <span class="nav-label-line"></span>
                        <span>Paramètres</span>
                    </div>
                    <i class="bi bi-chevron-down nav-arrow"></i>
                </div>
                <ul class="nav-submenu">
                    <li>
                        <a href="/parametres" class="{{ request()->is('parametres*') ? 'active' : '' }}">
                            <div class="nav-icon-box"><i class="bi bi-gear-fill"></i></div>
                            <span>Général</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>

        <div class="sidebar-footer">
            <div class="footer-card">
                <div class="footer-user">
                    <div class="footer-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="footer-info">
                        <span class="footer-name">{{ Auth::check() ? Auth::user()->name : 'Admin' }}</span>
                        <div class="footer-role">
                            <span class="footer-role-dot"></span>
                            <span>En ligne</span>
                        </div>
                    </div>
                    <form method="POST" action="/logout" style="margin:0;" onsubmit="handleLogout(event)">
                        @csrf
                        <button type="submit" class="footer-logout" title="Déconnexion"
                            style="border:none; background:none; cursor:pointer;">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="footer-copy text-light">&copy; {{ date('Y') }} Sofrebak — Tous droits réservés</div>
        </div>
    </aside>

    <!-- ════════ MAIN ════════ -->
    <div class="main-content">

        <div class="top-bar">
            <div class="top-bar-left">
                <button class="top-bar-btn" id="sidebarToggle" onclick="toggleSidebar()" style="margin-right: 0.8rem;" title="Masquer/Afficher le menu">
                    <i class="bi bi-list" style="font-size: 1.3rem;"></i>
                </button>
                <h5>@yield('title', 'Dashboard')</h5>
                <div class="top-bar-badge">
                    <i class="bi bi-circle-fill" style="color:#4ade80; font-size:0.45rem;"></i>
                    En ligne
                </div>
            </div>
            <div class="top-bar-right">
                <div class="notification-wrapper">
                    <a class="top-bar-btn" title="Notifications" id="notificationDropdownToggle"
                        onclick="toggleNotificationDropdown(event)" style="position: relative;">
                        <i class="bi bi-bell"></i>
                        @if(isset($expiredFactures) && $expiredFactures->count() > 0)
                            <span class="notification-badge-icon">{{ $expiredFactures->count() }}</span>
                        @endif
                    </a>

                    <div class="notification-dropdown" id="notificationDropdown">
                        <div class="notification-header">
                            <span>Notifications</span>
                            @if(isset($expiredFactures) && $expiredFactures->count() > 0)
                                <span class="notification-header-badge">{{ $expiredFactures->count() }} nouvelles</span>
                            @endif
                        </div>
                        <div class="notification-list">
                            @if(isset($expiredFactures) && $expiredFactures->count() > 0)
                                @foreach($expiredFactures as $facture)
                                    <a href="/factures/{{ $facture->id }}/edit" class="notification-item" data-id="{{ $facture->id }}">
                                        <div class="notification-icon">
                                            <i class="bi bi-exclamation-triangle-fill"></i>
                                        </div>
                                        <div style="flex: 1;">
                                            <div class="notification-title">Facture Échue : {{ $facture->numero_facture }}</div>
                                            <div class="notification-desc">Échéance était le
                                                {{ \Carbon\Carbon::parse($facture->date_echeance)->format('d/m/Y') }}.</div>
                                            <div class="notification-time">
                                                <i class="bi bi-clock"></i> Dépassé de
                                                {{ max(1, floor(\Carbon\Carbon::parse($facture->date_echeance)->diffInDays(\Carbon\Carbon::now()))) }}
                                                jour(s)
                                            </div>
                                        </div>
                                        <button class="notification-close-btn" onclick="dismissNotification(event, '{{ $facture->id }}')" title="Supprimer la notification">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </a>
                                @endforeach
                            @else
                                <div class="empty-notifications">
                                    <i class="bi bi-bell-slash"></i>
                                    Aucune notification
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="top-bar-divider"></div>
                <div class="admin-dropdown-wrapper">
                    <div class="top-bar-user" id="adminDropdownToggle" onclick="toggleAdminDropdown(event)">
                        <div class="top-bar-avatar"><i class="bi bi-person-fill"></i></div>
                        <span class="top-bar-username">{{ Auth::check() ? Auth::user()->name : 'Admin' }}</span>
                        <i class="bi bi-chevron-down"
                            style="font-size:0.6rem; color:#94a3b8; margin-left:2px; transition: transform 0.3s ease;"
                            id="adminChevron"></i>
                    </div>
                    <div class="admin-dropdown" id="adminDropdown">
                        <div class="dropdown-header">
                            <div class="dropdown-header-name">{{ Auth::check() ? Auth::user()->name : 'Admin' }}</div>
                            <div class="dropdown-header-email">{{ Auth::check() ? Auth::user()->email :
                                'admin@sofrebak.com' }}</div>
                        </div>
                        <a href="/dashboard" class="dropdown-item-link">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="/parametres" class="dropdown-item-link">
                            <i class="bi bi-gear"></i>
                            <span>Paramètres</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="/logout" id="logoutForm" onsubmit="handleLogout(event)">
                            @csrf
                            <button type="submit" class="dropdown-item-link logout-link">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Déconnexion</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">
            @yield('content')
        </div>

    </div>

    <script>
        // Toggle Sidebar
        function toggleSidebar() {
            document.body.classList.toggle('sidebar-collapsed');
        }

        function toggleSection(label) {
            const submenu = label.nextElementSibling;
            if (submenu.classList.contains('hide')) {
                submenu.classList.remove('hide');
                label.classList.remove('collapsed');
            } else {
                submenu.classList.add('hide');
                label.classList.add('collapsed');
            }
        }

        // Admin dropdown toggle
        function toggleAdminDropdown(event) {
            event.stopPropagation();
            const dropdown = document.getElementById('adminDropdown');
            const chevron = document.getElementById('adminChevron');
            const notifDropdown = document.getElementById('notificationDropdown');
            if (notifDropdown) notifDropdown.classList.remove('show');

            dropdown.classList.toggle('show');
            chevron.style.transform = dropdown.classList.contains('show') ? 'rotate(180deg)' : 'rotate(0deg)';
        }

        // Notification dropdown toggle
        function toggleNotificationDropdown(event) {
            event.stopPropagation();
            const dropdown = document.getElementById('notificationDropdown');
            const adminDropdown = document.getElementById('adminDropdown');
            const adminChevron = document.getElementById('adminChevron');
            if (adminDropdown) {
                adminDropdown.classList.remove('show');
                if (adminChevron) adminChevron.style.transform = 'rotate(0deg)';
            }

            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            const adminDropdown = document.getElementById('adminDropdown');
            const adminToggle = document.getElementById('adminDropdownToggle');
            const adminChevron = document.getElementById('adminChevron');
            if (adminDropdown && !adminDropdown.contains(event.target) && !adminToggle.contains(event.target)) {
                adminDropdown.classList.remove('show');
                if (adminChevron) adminChevron.style.transform = 'rotate(0deg)';
            }

            const notifDropdown = document.getElementById('notificationDropdown');
            const notifToggle = document.getElementById('notificationDropdownToggle');
            if (notifDropdown && !notifDropdown.contains(event.target) && !notifToggle.contains(event.target)) {
                notifDropdown.classList.remove('show');
            }
        });

        // Notifications local storage management
        function dismissNotification(event, factureId) {
            event.preventDefault();
            event.stopPropagation();
            
            let dismissed = JSON.parse(localStorage.getItem('dismissedFactures') || '[]');
            if (!dismissed.includes(factureId.toString())) {
                dismissed.push(factureId.toString());
                localStorage.setItem('dismissedFactures', JSON.stringify(dismissed));
            }
            
            const item = event.target.closest('.notification-item');
            if (item) {
                item.remove();
            }
            
            updateNotificationCount();
        }

        function updateNotificationCount() {
            const list = document.querySelector('.notification-list');
            if(!list) return;

            const items = list.querySelectorAll('.notification-item');
            const count = items.length;
            
            const badgeIcon = document.querySelector('.notification-badge-icon');
            const badgeHeader = document.querySelector('.notification-header-badge');
            
            if (count > 0) {
                if(badgeIcon) {
                    badgeIcon.textContent = count;
                    badgeIcon.style.display = 'flex';
                }
                if(badgeHeader) {
                    badgeHeader.textContent = count + ' nouvelles';
                    badgeHeader.style.display = 'inline-block';
                }
            } else {
                if(badgeIcon) badgeIcon.style.display = 'none';
                if(badgeHeader) badgeHeader.style.display = 'none';
                list.innerHTML = `
                    <div class="empty-notifications">
                        <i class="bi bi-bell-slash"></i>
                        Aucune notification
                    </div>
                `;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const dismissed = JSON.parse(localStorage.getItem('dismissedFactures') || '[]');
            if(dismissed.length > 0) {
                const items = document.querySelectorAll('.notification-item');
                let removedAny = false;
                items.forEach(item => {
                    const id = item.getAttribute('data-id');
                    if (id && dismissed.includes(id)) {
                        item.remove();
                        removedAny = true;
                    }
                });
                if (removedAny) {
                    updateNotificationCount();
                }
            }
        });
    </script>
    <!-- ════════ CUSTOM LOGOUT MODAL ════════ -->
    <div class="custom-modal-overlay" id="logoutModal">
        <div class="custom-modal-content">
            <div class="custom-modal-header">
                <div class="custom-modal-icon">
                    <i class="bi bi-box-arrow-right"></i>
                </div>
                <h4>Déconnexion</h4>
            </div>
            <div class="custom-modal-body">
                <p>Êtes-vous sûr de vouloir vous déconnecter de votre session ?</p>
            </div>
            <div class="custom-modal-footer">
                <button class="modal-btn btn-cancel" onclick="closeLogoutModal()">Annuler</button>
                <button class="modal-btn btn-confirm" onclick="confirmLogout()">Déconnexion</button>
            </div>
        </div>
    </div>

    <script>
        let formToSubmit = null;

        function handleLogout(event, formId) {
            event.preventDefault();
            formToSubmit = document.getElementById(formId) || event.target.closest('form');
            document.getElementById('logoutModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.remove('active');
            document.body.style.overflow = '';
            formToSubmit = null;
        }

        function confirmLogout() {
            if (formToSubmit) {
                formToSubmit.submit();
            }
        }

        // Close on overlay click
        document.getElementById('logoutModal').addEventListener('click', function(e) {
            if (e.target === this) closeLogoutModal();
        });
    </script>
</body>
</html>