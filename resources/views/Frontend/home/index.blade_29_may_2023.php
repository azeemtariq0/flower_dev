@extends('Frontend.layouts.master')
@section('content')
    <style>
        .my-checks {
            display: block;
            margin-bottom: 15px;
        }

        .my-checks input {
            padding: 0;
            height: initial;
            width: initial;
            margin-bottom: 0;
            display: none;
            cursor: pointer;
        }

        .my-checks label {
            position: relative;
            cursor: pointer;
        }

        .my-checks label:before {
            content: '';
            -webkit-appearance: none;
            background-color: transparent;
            border: 2px solid #0079bf;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
            padding: 10px;
            display: inline-block;
            position: relative;
            vertical-align: middle;
            cursor: pointer;
            margin-right: 5px;
        }

        .my-checks input:checked + label:after {
            content: '';
            display: block;
            position: absolute;
            top: 2px;
            left: 9px;
            width: 6px;
            height: 14px;
            border: solid #0079bf;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .text-abc {
            white-space: normal;
            overflow: hidden;
            line-height: 1.5em;
            height: 3em;
            text-overflow: ellipsis;
        }

        .active.days_limit {
            padding: 7.5px 7.44846px 8.5px 9.84842px;
            background: #E6542D;
            border-radius: 20px;
            color: #fff;
        }

        .days_limit.active a {
            color: #fff;

        }

        .days_limit.active a:after {
            opacity: 1;
        }

        .days_limit a {
            padding: 8px 7px;
        }

        .sec_destinations .slick-slide div img {
            width: 100%;
            height: 210px;
            object-fit: cover;
        }

        .themes_sec_inner {
            min-height: 122px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2px;
        }

        .days_limit {
            padding: 0px !important
        }

        .p48 {
            padding: 48px !important;
        }

        .themes_sec_inner:hover {
            background: #f2f2f2;
        }

        .sbc5 {
            background-color: #f2f2f2;
        }

        .css-23ymlk {
            width: 72px;
            height: 72px;
        }

        .text-center {
            text-align: center;
        }

        .block {
            display: block !important;
        }

        .mauto {
            margin: 0 auto;
        }

        .relative {
            position: relative !important;
        }

        .mb0 {
            margin-bottom: 0 !important;
        }

        .mt15 {
            margin-top: 15px !important;
        }

        .fw9 {
            font-weight: 900;
        }

        .f16p {
            font-size: 16px;
            line-height: 24px;
        }

        .options li {
            text-align: start;
        }

        .spinner-border {
            --docsearch-text-color: #1c1e21;
            --docsearch-spacing: 12px;
            --docsearch-icon-stroke-width: 1.4;
            --docsearch-muted-color: #969faf;
            --docsearch-container-background: rgba(101, 108, 133, 0.8);
            --docsearch-modal-width: 560px;
            --docsearch-modal-height: 600px;
            --docsearch-modal-background: #f5f6f7;
            --docsearch-modal-shadow: inset 1px 1px 0 0 hsla(0, 0%, 100%, 0.5), 0 3px 8px 0 #555a64;
            --docsearch-searchbox-height: 56px;
            --docsearch-searchbox-background: #ebedf0;
            --docsearch-searchbox-focus-background: #fff;
            --docsearch-hit-height: 56px;
            --docsearch-hit-color: #444950;
            --docsearch-hit-active-color: #fff;
            --docsearch-hit-background: #fff;
            --docsearch-hit-shadow: 0 1px 3px 0 #d4d9e1;
            --docsearch-key-gradient: linear-gradient(-225deg, #d5dbe4, #f8f8f8);
            --docsearch-key-shadow: inset 0 -2px 0 0 #cdcde6, inset 0 0 1px 1px #fff, 0 1px 2px 1px rgba(30, 35, 90, 0.4);
            --docsearch-footer-height: 44px;
            --docsearch-footer-background: #fff;
            --docsearch-footer-shadow: 0 -1px 0 0 #e0e3e8, 0 -3px 6px 0 rgba(69, 98, 155, 0.12);
            --bs-blue: #0d6efd;
            --bs-indigo: #6610f2;
            --bs-purple: #6f42c1;
            --bs-pink: #d63384;
            --bs-red: #dc3545;
            --bs-orange: #fd7e14;
            --bs-yellow: #ffc107;
            --bs-green: #198754;
            --bs-teal: #20c997;
            --bs-cyan: #0dcaf0;
            --bs-black: #000;
            --bs-white: #fff;
            --bs-gray: #6c757d;
            --bs-gray-dark: #343a40;
            --bs-gray-100: #f8f9fa;
            --bs-gray-200: #e9ecef;
            --bs-gray-300: #dee2e6;
            --bs-gray-400: #ced4da;
            --bs-gray-500: #adb5bd;
            --bs-gray-600: #6c757d;
            --bs-gray-700: #495057;
            --bs-gray-800: #343a40;
            --bs-gray-900: #212529;
            --bs-primary: #0d6efd;
            --bs-secondary: #6c757d;
            --bs-success: #198754;
            --bs-info: #0dcaf0;
            --bs-warning: #ffc107;
            --bs-danger: #dc3545;
            --bs-light: #f8f9fa;
            --bs-dark: #212529;
            --bs-primary-rgb: 13, 110, 253;
            --bs-secondary-rgb: 108, 117, 125;
            --bs-success-rgb: 25, 135, 84;
            --bs-info-rgb: 13, 202, 240;
            --bs-warning-rgb: 255, 193, 7;
            --bs-danger-rgb: 220, 53, 69;
            --bs-light-rgb: 248, 249, 250;
            --bs-dark-rgb: 33, 37, 41;
            --bs-white-rgb: 255, 255, 255;
            --bs-black-rgb: 0, 0, 0;
            --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", "Liberation Sans", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
            --bs-body-font-family: var(--bs-font-sans-serif);
            --bs-body-font-size: 1rem;
            --bs-body-font-weight: 400;
            --bs-body-line-height: 1.5;
            --bs-link-decoration: underline;
            --bs-border-width: 1px;
            --bs-border-style: solid;
            --bs-border-radius: 0.375rem;
            --bs-border-radius-sm: 0.25rem;
            --bs-border-radius-lg: 0.5rem;
            --bs-border-radius-xl: 1rem;
            --bs-border-radius-2xl: 2rem;
            --bs-border-radius-pill: 50rem;
            --bs-box-shadow: 0 0.5rem 1rem rgba(var(--bs-body-color-rgb), 0.15);
            --bs-box-shadow-sm: 0 0.125rem 0.25rem rgba(var(--bs-body-color-rgb), 0.075);
            --bs-box-shadow-lg: 0 1rem 3rem rgba(var(--bs-body-color-rgb), 0.175);
            --bs-box-shadow-inset: inset 0 1px 2px rgba(var(--bs-body-color-rgb), 0.075);
            --bs-form-control-bg: var(--bs-body-bg);
            --bs-highlight-bg: #fff3cd;
            --bs-breakpoint-xs: 0;
            --bs-breakpoint-sm: 576px;
            --bs-breakpoint-md: 768px;
            --bs-breakpoint-lg: 992px;
            --bs-breakpoint-xl: 1200px;
            --bs-breakpoint-xxl: 1400px;
            --bs-body-color: #adb5bd;
            --bs-body-color-rgb: 173, 181, 189;
            --bs-body-bg: #212529;
            --bs-body-bg-rgb: 33, 37, 41;
            --bs-emphasis-color-rgb: 248, 249, 250;
            --bs-secondary-color: rgba(173, 181, 189, 0.75);
            --bs-secondary-color-rgb: 173, 181, 189;
            --bs-secondary-bg: #343a40;
            --bs-secondary-bg-rgb: 52, 58, 64;
            --bs-tertiary-color: rgba(173, 181, 189, 0.5);
            --bs-tertiary-color-rgb: 173, 181, 189;
            --bs-tertiary-bg: #2b3035;
            --bs-tertiary-bg-rgb: 43, 48, 53;
            --bs-emphasis-color: #fff;
            --bs-primary-text: #6ea8fe;
            --bs-secondary-text: #dee2e6;
            --bs-success-text: #75b798;
            --bs-info-text: #6edff6;
            --bs-warning-text: #ffda6a;
            --bs-danger-text: #ea868f;
            --bs-light-text: #f8f9fa;
            --bs-dark-text: #dee2e6;
            --bs-primary-bg-subtle: #031633;
            --bs-secondary-bg-subtle: #212529;
            --bs-success-bg-subtle: #051b11;
            --bs-info-bg-subtle: #032830;
            --bs-warning-bg-subtle: #332701;
            --bs-danger-bg-subtle: #2c0b0e;
            --bs-light-bg-subtle: #343a40;
            --bs-dark-bg-subtle: #1a1d20;
            --bs-primary-border-subtle: #084298;
            --bs-secondary-border-subtle: #495057;
            --bs-success-border-subtle: #0f5132;
            --bs-info-border-subtle: #055160;
            --bs-warning-border-subtle: #664d03;
            --bs-danger-border-subtle: #842029;
            --bs-light-border-subtle: #495057;
            --bs-dark-border-subtle: #343a40;
            --bs-heading-color: #fff;
            --bs-link-color: #6ea8fe;
            --bs-link-hover-color: #9ec5fe;
            --bs-link-color-rgb: 110, 168, 254;
            --bs-link-hover-color-rgb: 158, 197, 254;
            --bs-code-color: #e685b5;
            --bs-border-color: #495057;
            --bs-border-color-translucent: rgba(255, 255, 255, 0.15);
            --bd-purple: #4c0bce;
            --bd-accent: #ffe484;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
            --bd-accent-rgb: 255, 228, 132;
            --bd-pink-rgb: 214, 51, 132;
            --bd-teal-rgb: 32, 201, 151;
            --bd-violet: #9461fb;
            --bd-violet-bg: #712cf9;
            --bd-sidebar-link-bg: rgba(84, 33, 187, .5);
            --base00: #282c34;
            --base01: #353b45;
            --base02: #3e4451;
            --base03: #868e96;
            --base04: #565c64;
            --base05: #abb2bf;
            --base06: #b6bdca;
            --base07: #d19a66;
            --base08: #e06c75;
            --base09: #d19a66;
            --base0A: #e5c07b;
            --base0B: #98c379;
            --base0C: #56b6c2;
            --base0D: #61afef;
            --base0E: #c678dd;
            --base0F: #be5046;
            font-family: var(--bs-body-font-family);
            font-size: var(--bs-body-font-size);
            font-weight: var(--bs-body-font-weight);
            line-height: var(--bs-body-line-height);
            color: var(--bs-body-color);
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
            --bs-gutter-y: 0;
            --bs-gutter-x: 3rem;
            --bd-example-padding: 1.5rem;
            box-sizing: border-box;
            display: inline-block;
            width: var(--bs-spinner-width);
            height: var(--bs-spinner-height);
            vertical-align: var(--bs-spinner-vertical-align);
            border-radius: 50%;
            animation: var(--bs-spinner-animation-speed) linear infinite var(--bs-spinner-animation-name);
            --bs-spinner-width: 2rem;
            --bs-spinner-height: 2rem;
            --bs-spinner-vertical-align: -0.125em;
            --bs-spinner-border-width: 0.25em;
            --bs-spinner-animation-speed: 0.75s;
            --bs-spinner-animation-name: spinner-border;
            border: var(--bs-spinner-border-width) solid currentcolor;
            border-right-color: transparent;
            margin-bottom: 0;
        }

        .spinner-border .visually-hidden {
            --docsearch-text-color: #1c1e21;
            --docsearch-spacing: 12px;
            --docsearch-icon-stroke-width: 1.4;
            --docsearch-muted-color: #969faf;
            --docsearch-container-background: rgba(101, 108, 133, 0.8);
            --docsearch-modal-width: 560px;
            --docsearch-modal-height: 600px;
            --docsearch-modal-background: #f5f6f7;
            --docsearch-modal-shadow: inset 1px 1px 0 0 hsla(0, 0%, 100%, 0.5), 0 3px 8px 0 #555a64;
            --docsearch-searchbox-height: 56px;
            --docsearch-searchbox-background: #ebedf0;
            --docsearch-searchbox-focus-background: #fff;
            --docsearch-hit-height: 56px;
            --docsearch-hit-color: #444950;
            --docsearch-hit-active-color: #fff;
            --docsearch-hit-background: #fff;
            --docsearch-hit-shadow: 0 1px 3px 0 #d4d9e1;
            --docsearch-key-gradient: linear-gradient(-225deg, #d5dbe4, #f8f8f8);
            --docsearch-key-shadow: inset 0 -2px 0 0 #cdcde6, inset 0 0 1px 1px #fff, 0 1px 2px 1px rgba(30, 35, 90, 0.4);
            --docsearch-footer-height: 44px;
            --docsearch-footer-background: #fff;
            --docsearch-footer-shadow: 0 -1px 0 0 #e0e3e8, 0 -3px 6px 0 rgba(69, 98, 155, 0.12);
            --bs-blue: #0d6efd;
            --bs-indigo: #6610f2;
            --bs-purple: #6f42c1;
            --bs-pink: #d63384;
            --bs-red: #dc3545;
            --bs-orange: #fd7e14;
            --bs-yellow: #ffc107;
            --bs-green: #198754;
            --bs-teal: #20c997;
            --bs-cyan: #0dcaf0;
            --bs-black: #000;
            --bs-white: #fff;
            --bs-gray: #6c757d;
            --bs-gray-dark: #343a40;
            --bs-gray-100: #f8f9fa;
            --bs-gray-200: #e9ecef;
            --bs-gray-300: #dee2e6;
            --bs-gray-400: #ced4da;
            --bs-gray-500: #adb5bd;
            --bs-gray-600: #6c757d;
            --bs-gray-700: #495057;
            --bs-gray-800: #343a40;
            --bs-gray-900: #212529;
            --bs-primary: #0d6efd;
            --bs-secondary: #6c757d;
            --bs-success: #198754;
            --bs-info: #0dcaf0;
            --bs-warning: #ffc107;
            --bs-danger: #dc3545;
            --bs-light: #f8f9fa;
            --bs-dark: #212529;
            --bs-primary-rgb: 13, 110, 253;
            --bs-secondary-rgb: 108, 117, 125;
            --bs-success-rgb: 25, 135, 84;
            --bs-info-rgb: 13, 202, 240;
            --bs-warning-rgb: 255, 193, 7;
            --bs-danger-rgb: 220, 53, 69;
            --bs-light-rgb: 248, 249, 250;
            --bs-dark-rgb: 33, 37, 41;
            --bs-white-rgb: 255, 255, 255;
            --bs-black-rgb: 0, 0, 0;
            --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", "Liberation Sans", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
            --bs-body-font-family: var(--bs-font-sans-serif);
            --bs-body-font-size: 1rem;
            --bs-body-font-weight: 400;
            --bs-body-line-height: 1.5;
            --bs-link-decoration: underline;
            --bs-border-width: 1px;
            --bs-border-style: solid;
            --bs-border-radius: 0.375rem;
            --bs-border-radius-sm: 0.25rem;
            --bs-border-radius-lg: 0.5rem;
            --bs-border-radius-xl: 1rem;
            --bs-border-radius-2xl: 2rem;
            --bs-border-radius-pill: 50rem;
            --bs-box-shadow: 0 0.5rem 1rem rgba(var(--bs-body-color-rgb), 0.15);
            --bs-box-shadow-sm: 0 0.125rem 0.25rem rgba(var(--bs-body-color-rgb), 0.075);
            --bs-box-shadow-lg: 0 1rem 3rem rgba(var(--bs-body-color-rgb), 0.175);
            --bs-box-shadow-inset: inset 0 1px 2px rgba(var(--bs-body-color-rgb), 0.075);
            --bs-form-control-bg: var(--bs-body-bg);
            --bs-highlight-bg: #fff3cd;
            --bs-breakpoint-xs: 0;
            --bs-breakpoint-sm: 576px;
            --bs-breakpoint-md: 768px;
            --bs-breakpoint-lg: 992px;
            --bs-breakpoint-xl: 1200px;
            --bs-breakpoint-xxl: 1400px;
            --bs-body-color: #adb5bd;
            --bs-body-color-rgb: 173, 181, 189;
            --bs-body-bg: #212529;
            --bs-body-bg-rgb: 33, 37, 41;
            --bs-emphasis-color-rgb: 248, 249, 250;
            --bs-secondary-color: rgba(173, 181, 189, 0.75);
            --bs-secondary-color-rgb: 173, 181, 189;
            --bs-secondary-bg: #343a40;
            --bs-secondary-bg-rgb: 52, 58, 64;
            --bs-tertiary-color: rgba(173, 181, 189, 0.5);
            --bs-tertiary-color-rgb: 173, 181, 189;
            --bs-tertiary-bg: #2b3035;
            --bs-tertiary-bg-rgb: 43, 48, 53;
            --bs-emphasis-color: #fff;
            --bs-primary-text: #6ea8fe;
            --bs-secondary-text: #dee2e6;
            --bs-success-text: #75b798;
            --bs-info-text: #6edff6;
            --bs-warning-text: #ffda6a;
            --bs-danger-text: #ea868f;
            --bs-light-text: #f8f9fa;
            --bs-dark-text: #dee2e6;
            --bs-primary-bg-subtle: #031633;
            --bs-secondary-bg-subtle: #212529;
            --bs-success-bg-subtle: #051b11;
            --bs-info-bg-subtle: #032830;
            --bs-warning-bg-subtle: #332701;
            --bs-danger-bg-subtle: #2c0b0e;
            --bs-light-bg-subtle: #343a40;
            --bs-dark-bg-subtle: #1a1d20;
            --bs-primary-border-subtle: #084298;
            --bs-secondary-border-subtle: #495057;
            --bs-success-border-subtle: #0f5132;
            --bs-info-border-subtle: #055160;
            --bs-warning-border-subtle: #664d03;
            --bs-danger-border-subtle: #842029;
            --bs-light-border-subtle: #495057;
            --bs-dark-border-subtle: #343a40;
            --bs-heading-color: #fff;
            --bs-link-color: #6ea8fe;
            --bs-link-hover-color: #9ec5fe;
            --bs-link-color-rgb: 110, 168, 254;
            --bs-link-hover-color-rgb: 158, 197, 254;
            --bs-code-color: #e685b5;
            --bs-border-color: #495057;
            --bs-border-color-translucent: rgba(255, 255, 255, 0.15);
            --bd-purple: #4c0bce;
            --bd-accent: #ffe484;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
            --bd-accent-rgb: 255, 228, 132;
            --bd-pink-rgb: 214, 51, 132;
            --bd-teal-rgb: 32, 201, 151;
            --bd-violet: #9461fb;
            --bd-violet-bg: #712cf9;
            --bd-sidebar-link-bg: rgba(84, 33, 187, .5);
            --base00: #282c34;
            --base01: #353b45;
            --base02: #3e4451;
            --base03: #868e96;
            --base04: #565c64;
            --base05: #abb2bf;
            --base06: #b6bdca;
            --base07: #d19a66;
            --base08: #e06c75;
            --base09: #d19a66;
            --base0A: #e5c07b;
            --base0B: #98c379;
            --base0C: #56b6c2;
            --base0D: #61afef;
            --base0E: #c678dd;
            --base0F: #be5046;
            font-family: var(--bs-body-font-family);
            font-size: var(--bs-body-font-size);
            font-weight: var(--bs-body-font-weight);
            line-height: var(--bs-body-line-height);
            color: var(--bs-body-color);
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
            --bs-gutter-y: 0;
            --bs-gutter-x: 3rem;
            --bd-example-padding: 1.5rem;
            --bs-spinner-width: 2rem;
            --bs-spinner-height: 2rem;
            --bs-spinner-vertical-align: -0.125em;
            --bs-spinner-border-width: 0.25em;
            --bs-spinner-animation-speed: 0.75s;
            --bs-spinner-animation-name: spinner-border;
            box-sizing: border-box;
            position: absolute !important;
            width: 1px !important;
            height: 1px !important;
            padding: 0 !important;
            margin: -1px !important;
            overflow: hidden !important;
            clip: rect(0, 0, 0, 0) !important;
            white-space: nowrap !important;
            border: 0 !important;
        }

        #more {
            display: none;
        }

        .filter-option {
            display: flex;
            align-items: center;
        }

        .btn .dropdown-toggle {
            display: flex;
            align-items: center;
        }

        @keyframes spinner-border {
            to {
                transform: rotate(360deg);
            }

            from {

                transform: rotate(0deg);
            }
        }

        .multi-select-dropdown {
            position: relative;
            width: 200px;
        }

        .open ul {
            display: block;
        }

        /* .selected-options {
            display: flex;
            flex-wrap: wrap;
            padding: 8px 12px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
            } */

        .selected-option {
            width: 100%;
            margin-right: 26px;
            /* padding-block: 0px; */
        }

        .selected-options {
            padding-block: 0px !important;
        }

        .selected-option p {
            padding: 10px;
        }

        .selected-option-list {
            display: flex;
            overflow: auto;
        }

        .selected-option-list::-webkit-scrollbar {
            display: none;
        }

        .options {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            z-index: 1;
            padding: 0;
            margin: 0;
            list-style: none;
            background-color: #fff;
            border: 1px solid #ccc;
            border-top: none;
            border-radius: 0 0 4px 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .options li {
            padding: 8px 12px;
            cursor: pointer;
        }

        .options li:hover {
            background-color: #f2f2f2;
        }

        .select-dd li label input[type="checkbox"] {
            margin-right: 8px;
        }

        .select-dd li label input[type="hidden"] {
            /* display: none; */
        }

        @media screen and (max-width: 700px) {

            .select_duration {
                width: 100% !important;
                margin: 0 !important;
            }
        }

        /* .selected-options {
            padding: 0px !important;
            } */
        .getwayslider {
            height: 300px !important;
        }

        .getwayslider > div {
            width: 100%;
            height: 200px;
        }

        .getwayslider > div img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
    <section class="sec main_sec section text-center" id="explore">
        <div class="container">
            <div class="row">
                <h1>{{$translate =App\Helpers\Menus::Translator(63,$code)}}<br>
                    {{$translate =App\Helpers\Menus::Translator(14,$code)}}</h1>
                <p>{{$translate =App\Helpers\Menus::Translator(11,$code)}}</p>
            </div>
            <div class="row">
                <div class="form_main_wrap">
                    <form class="d-flex" method="GET" action="{{url('tour-package', ['selectedValue' => 'default']) }}">
                        @csrf
                        <select name="slug" id="option" class="select_dest" required>
                            <option selected disabled
                                    value="">{{$translate =App\Helpers\Menus::Translator(48,$code)}}</option>
                            @if(isset($citys))
                                @foreach($citys as $city)
                                    <option value="{{$city->slug}}">{{$city->title ?? ''}}</option>
                                @endforeach
                            @endif
                        </select>

                        <!-- <select class="select_duration selectpicker" multiple>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    <option value="4">Four</option>
                                </select> -->

                        <div class="multi-select-dropdown ">
                            <div class="selected-options select select_duration">
                                <div class="selected-option " id="selectop-none">
                                    <p> {{$translate =App\Helpers\Menus::Translator(50,$code)}}</p>
                                </div>
                                <div class="selected-option-list" id="padding-0"></div>
                            </div>
                            <ul class="options select-dd ">
                                <li>
                                    <label>
                                        <input type="checkbox" name="option1" value="1-3">
                                        {{$translate =App\Helpers\Menus::Translator(52,$code)}}
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="checkbox" name="option2"
                                               value="4-6">{{$translate =App\Helpers\Menus::Translator(53,$code)}}
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="checkbox" name="option3"
                                               value="7-9">{{$translate =App\Helpers\Menus::Translator(54,$code)}}
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="checkbox" name="option4"
                                               value="10-12">{{$translate =App\Helpers\Menus::Translator(55,$code)}}
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="checkbox" name="option5" value="13-31">13 days or more
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="checkbox" name="option5"
                                               value="">{{$translate =App\Helpers\Menus::Translator(57,$code)}}
                                    </label>
                                </li>
                            </ul>
                            <input type="hidden" name="selected-option-values" value="">
                        </div>


                        <!-- <select name="days" class=" select_duration">
                                <option selected disabled>Select duration</option>
                                <option value="1-3" data-content="<input type='checkbox' id='1to3'>">13 </option>
                                <option value="4-6">4 to 6 days</option>
                                <option value="7-9">7 to 9 days</option>
                                <option value="10-12">10 to 12 days</option>
                                <option value="13-31">13 days or more</option>
                                <option value="">Not decided</option>
                            </select> -->
                        <select name="month" class="select_month">
                            <option selected disabled>{{$translate =App\Helpers\Menus::Translator(49,$code)}}</option>
                            @if(isset($months))
                                @foreach($months as $month)
                                    <option value="{{$month->season_package}}">{{$month->season_package ?? ''}}
                                        , {{ now()->year }}
                                    </option>
                                @endforeach
                            @endif
                            <option value="">Not decided</option>
                        </select>
                        <input type="hidden" name="lang" id="lang" value="{{$code ?? ''}}">
                        <input type="hidden" name="search_form" id="search_form" value="search_form">
                        <input type="submit" name="submit" value="Explore">
                    </form>
                    <div class="dedtination_not_sure text-left">{{$translate =App\Helpers\Menus::Translator(95,$code)}}
                        <a href="#destination">{{$translate =App\Helpers\Menus::Translator(96,$code)}}</a></div>
                </div>
            </div>
        </div>
    </section>
    <div class="sec sec_destinations section" id="destinations">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 explore">{{$translate =App\Helpers\Menus::Translator(12,$code)}}</div>

                <div class="col-sm-6 bets_package_note"><img
                            src="{{ asset('travel/images/phone.png') }}"> {{$translate =App\Helpers\Menus::Translator(51,$code)}}
                    <a href="tel:18001235555">{{$translate =App\Helpers\Menus::Translator(120,$code)}}</a></div>
            </div>
            <div class="row row_destinations slider_destinations">
                @if(isset($theme))
                    @foreach ($theme as $value)
                        <div class="col-sm-2">
                            <div>
                                @if ($value->image != null)
                                    @php $image = '/'.$value->image @endphp
                                @else
                                    @php $image = 'galleryimage.png' @endphp
                                @endif
                                <img style="" src="{{ asset('images/media' . '/' . $image) }}">
                                <a class="see-details-button absolute-center"
                                   href="{{url('tour',$value->slug)}}?lang={{$code ?? ''}}">View
                                    Detail</a>
                            </div>
                            <h3>{{$value->title ?? ''}}</h3>
                            <p>{{$translate =App\Helpers\Menus::Translator(59,$code)}}</p>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="row row_explore_selling" id="selling">
                <div class="explore_for_heading">{{$translate =App\Helpers\Menus::Translator(13,$code)}}</div>
                <div class="select_sell_for d-flex">
                    {{-- <a class="int_destinations"><input type="checkbox" name="sell_for" class="submit-form" value="international">--}}
                    {{-- <label>International--}}
                    {{-- Destinations</label>--}}
                    {{-- --}}
                    {{-- </a>--}}

                    <div class="my-checks int_destinations submit-form">
                        <input type="checkbox" name="sell_for" value="international" id="flexCheckDefault">
                        <label for="flexCheckDefault"> {{$translate =App\Helpers\Menus::Translator(25,$code)}}</label>
                    </div>

                    <div class="my-checks dest_within_uae submit-form">
                        <input type="checkbox" name="sell_for" value="United Arab Emirates" id="uae">
                        <label for="uae"> {{$translate =App\Helpers\Menus::Translator(26,$code)}}</label>
                    </div>

                    {{-- <div class="form-check int_destinations submit-form">--}}
                    {{-- <input class="form-check-input" type="checkbox" name="sell_for" value="international" id="flexCheckDefault">--}}
                    {{-- <label class="form-check-label" for="flexCheckDefault">--}}
                    {{-- International Destinations--}}
                    {{-- </label>--}}
                    {{-- </div>--}}

                    {{-- <div class="form-check dest_within_uae submit-form">--}}
                    {{-- <input class="form-check-input" type="checkbox" name="sell_for" value="United Arab Emirates" id="uae">--}}
                    {{-- <label class="form-check-label" for="uae">--}}
                    {{-- Destinations within UAE--}}
                    {{-- </label>--}}
                    {{-- </div>--}}

                    {{-- <a class="dest_within_uae"><input type="checkbox" name="sell_for" class="submit-form" value="United Arab Emirates">--}}
                    {{-- <label>Destinations within UAE</label>--}}

                    {{-- </a>--}}
                </div>
            </div>
            <div class="all_destinations" style="">
                <div class="days_main_wrap nav nav-tabs">
                    <div class="days_limit selling"><a class="filter" data-value="1-3">1
                            to 3 days</a></div>
                    <div class="days_limit selling"><a class="filter" data-value="4-6">4
                            to 6 days</a></div>
                    <div class="days_limit selling"><a class="filter" data-value="7-9">7
                            to 9 days</a></div>
                    <div class="days_limit selling"><a class="filter"
                                                       data-value="10-12">{{$translate =App\Helpers\Menus::Translator(55,$code)}}</a>
                    </div>
                    <div class="days_limit selling"><a class="filter" data-value="13-100">13
                            or more days</a></div>
                </div>
                <div class="">
                    <div id="explore_1_3">
                        <div class="row row_destinations_packages packages-view slider_destinations vvvv ">
                            @include('Frontend/snippets/search-selling')
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="internationa_destinations" style="display: none;">--}}

            {{-- <div class="days_main_wrap nav nav-tabs">--}}
            {{-- <div class="days_limit selling"><a class="filter" data-toggle="tab" data-value="1-3">1 to 3 days</a></div>--}}
            {{-- <div class="days_limit selling"><a class="filter" data-toggle="tab" data-value="4-6">4 to 6 days</a></div>--}}
            {{-- <div class="days_limit selling"><a class="filter" data-toggle="tab" data-value="7-9">7 to 9 days</a></div>--}}
            {{-- <div class="days_limit selling"><a class="filter" data-toggle="tab" data-value="10-12">10 to 12 days</a></div>--}}
            {{-- <div class="days_limit selling"><a class="filter" data-toggle="tab" data-value="13-100">10 to 12 days</a></div>--}}
            {{-- </div>--}}
            {{-- <div class="tab-content">--}}
            {{-- <div id="explore_1_3" class="tab-pane fade in active">--}}
            {{-- <div class="row row_destinations_packages slider_destinations vvvv">--}}
            {{-- @include('Frontend/snippets/destination')--}}
            {{-- </div>--}}
            {{-- </div>--}}
            {{-- </div>--}}
            {{-- </div>--}}

            {{-- <div class="destinations_within_uae" style="display: none;">--}}

            {{-- <div class="days_main_wrap nav nav-tabs">--}}
            {{-- <div class="days_limit selling"><a class="filter" data-toggle="tab" data-value="1-3">1 to 3 days</a>--}}
            {{-- </div>--}}
            {{-- <div class="days_limit selling"><a class="filter" data-toggle="tab" data-value="4-6">4 to 6 days</a>--}}
            {{-- </div>--}}
            {{-- <div class="days_limit selling"><a class="filter" data-toggle="tab" data-value="7-9">7 to 9 days</a>--}}
            {{-- </div>--}}
            {{-- <div class="days_limit selling"><a class="filter" data-toggle="tab" data-value="10-12">10 to 12--}}
            {{-- days</a></div>--}}
            {{-- <div class="days_limit selling"><a class="filter" data-toggle="tab" data-value="13-100">10 to 12--}}
            {{-- days</a></div>--}}
            {{-- </div>--}}
            {{-- <div class="tab-content">--}}
            {{-- <div id="explore_1_3" class="tab-pane fade in active">--}}
            {{-- <div class="row row_destinations_packages slider_destinations vvvv">--}}
            {{-- @include('Frontend/snippets/destination')--}}
            {{-- </div>--}}
            {{-- </div>--}}
            {{-- </div>--}}
            {{-- </div>--}}
        </div>
    </div>
    <section class="sec sec_holidays section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="heading1">{{$translate =App\Helpers\Menus::Translator(60,$code)}}</div>
                    <div class="heading2">{{$translate =App\Helpers\Menus::Translator(63,$code)}}</div>
                    <div class="heading3">{{$translate =App\Helpers\Menus::Translator(14,$code)}}</div>
                    <div class="heading4">in <span>{{$translate =App\Helpers\Menus::Translator(61,$code)}}</span></div>
                <!-- <div class="watch_video"><a href="#" data-toggle="modal" data-target="#myModal"> {{$translate =App\Helpers\Menus::Translator(62,$code)}}
                        </a></div> -->
                    <div class="watch_video"><a data-fancybox="gallery" href="https://youtu.be/2G6hYuXIaR8"> Watch
                            Video </a></div>
                </div>

                <div class="col-sm-6">
                    <div class="row text-center select_pkg">
                        <div class="col-sm-4">
                            <div class="select_pkg_img"><img src="{{ asset('travel/images/element1.png') }}"></div>
                            <h3>{{$translate =App\Helpers\Menus::Translator(32,$code)}}</h3>
                            <p>{{$translate =App\Helpers\Menus::Translator(33,$code)}}</p>
                        </div>

                        <div class="col-sm-4">
                            <div class="select_pkg_img"><img src="{{ asset('travel/images/element2.png') }}"></div>
                            <h3>{{$translate =App\Helpers\Menus::Translator(32,$code)}}</h3>
                            <p>{{$translate =App\Helpers\Menus::Translator(33,$code)}}</p>
                        </div>

                        <div class="col-sm-4">
                            <div class="select_pkg_img"><img src="{{ asset('travel/images/element3.png') }}"></div>
                            <h3>{{$translate =App\Helpers\Menus::Translator(32,$code)}}</h3>
                            <p>{{$translate =App\Helpers\Menus::Translator(33,$code)}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="sec happy section" id="travel_stories">
        <div class="container">
            <h1>Over 40 Lac+ Happy Travelers</h1>
            <p>{{$translate =App\Helpers\Menus::Translator(27,$code)}}</p>
        </div>

        <div class="container">
            <div class="row">
                <div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab"
                                              href="#tab1">{{$translate =App\Helpers\Menus::Translator(64,$code)}}</a>
                        </li>
                        <li><a data-toggle="tab"
                               href="#tab2">{{$translate =App\Helpers\Menus::Translator(65,$code)}}</a></li>
                        <li><a data-toggle="tab"
                               href="#tab3">{{$translate =App\Helpers\Menus::Translator(66,$code)}}</a></li>
                        <li><a data-toggle="tab"
                               href="#tab4">{{$translate =App\Helpers\Menus::Translator(67,$code)}}</a></li>
                        <li><a data-toggle="tab"
                               href="#tab5">{{$translate =App\Helpers\Menus::Translator(68,$code)}}</a></li>
                        <li><a data-toggle="tab"
                               href="#tab6">{{$translate =App\Helpers\Menus::Translator(69,$code)}}</a></li>
                        <li><a data-toggle="tab"
                               href="#tab7">{{$translate =App\Helpers\Menus::Translator(70,$code)}}</a></li>
                        <li>
                            <a href="{{ url('https://client.edwomtech.com/dopaminetravel_wp/') }}">{{$translate =App\Helpers\Menus::Translator(109,$code)}}</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row slider_inside_tab slider_inside_tab1">
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/1.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/2.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/1.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/2.png') }}"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 tab_data">
                                    <h3>{{$translate =App\Helpers\Menus::Translator(68,$code)}}</h3>
                                    <div class="tags">
                                        <span>{{$translate =App\Helpers\Menus::Translator(75,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(76,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(77,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(78,$code)}}</span>
                                    </div>
                                    <p>{{$translate =App\Helpers\Menus::Translator(72,$code)}}</p>
                                    <div class="row tab_row1">
                                        <div class="col-sm-1 nopad"><img
                                                    src="{{ asset('travel/images/image006.png') }}">
                                        </div>
                                        <div class="col-sm-7">
                                            <h5>{{$translate =App\Helpers\Menus::Translator(79,$code)}}</h5>
                                            <p>{{$translate =App\Helpers\Menus::Translator(80,$code)}}</p>
                                        </div>
                                        <div class="col-sm-4 pull-right right_text">Trip to Maldives</div>
                                    </div>
                                    <div class="row tab_row2">
                                        <div class="col-sm-4"><a
                                                    href="#">{{$translate =App\Helpers\Menus::Translator(82,$code)}}</a>
                                        </div>
                                        <div class="col-sm-8 nopad"><a href="#"
                                                                       class="btn1">{{$translate =App\Helpers\Menus::Translator(83,$code)}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab2" class="tab-pane fade">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row slider_inside_tab slider_inside_tab2">
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/1.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/2.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/1.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/2.png') }}"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 tab_data">
                                    <h3>{{$translate =App\Helpers\Menus::Translator(16,$code)}}</h3>
                                    <div class="tags">
                                        <span>{{$translate =App\Helpers\Menus::Translator(75,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(76,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(77,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(78,$code)}}</span>
                                    </div>
                                    <p>
                                        {{$translate =App\Helpers\Menus::Translator(72,$code)}} </p>
                                    <div class="row tab_row1">
                                        <div class="col-sm-1 nopad"><img
                                                    src="{{ asset('travel/images/image006.png') }}">
                                        </div>
                                        <div class="col-sm-7">
                                            <h5>{{$translate =App\Helpers\Menus::Translator(79,$code)}}</h5>
                                            <p>{{$translate =App\Helpers\Menus::Translator(80,$code)}}</p>
                                        </div>
                                        <div class="col-sm-4 pull-right right_text">Trip to Maldives</div>
                                    </div>
                                    <div class="row tab_row2">
                                        <div class="col-sm-4"><a
                                                    href="#">{{$translate =App\Helpers\Menus::Translator(82,$code)}}</a>
                                        </div>
                                        <div class="col-sm-8 nopad"><a href="#"
                                                                       class="btn1">{{$translate =App\Helpers\Menus::Translator(83,$code)}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab3" class="tab-pane fade">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row slider_inside_tab slider_inside_tab3">
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/1.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/2.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/1.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/2.png') }}"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 tab_data">
                                    <h3>{{$translate =App\Helpers\Menus::Translator(16,$code)}}</h3>
                                    <div class="tags">
                                        <span>{{$translate =App\Helpers\Menus::Translator(75,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(76,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(77,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(78,$code)}}</span>
                                    </div>
                                    <p>{{$translate =App\Helpers\Menus::Translator(72,$code)}}</p>
                                    <div class="row tab_row1">
                                        <div class="col-sm-1 nopad"><img
                                                    src="{{ asset('travel/images/image006.png') }}">
                                        </div>
                                        <div class="col-sm-7">
                                            <h5>{{$translate =App\Helpers\Menus::Translator(79,$code)}}</h5>
                                            <p>{{$translate =App\Helpers\Menus::Translator(80,$code)}}</p>
                                        </div>
                                        <div class="col-sm-4 pull-right right_text">{{$translate =App\Helpers\Menus::Translator(81,$code)}}</div>
                                    </div>
                                    <div class="row tab_row2">
                                        <div class="col-sm-4"><a href="#">Read Full Story</a></div>
                                        <div class="col-sm-8 nopad"><a href="#"
                                                                       class="btn1">{{$translate =App\Helpers\Menus::Translator(83,$code)}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab4" class="tab-pane fade">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row slider_inside_tab slider_inside_tab4">
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/1.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/2.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/1.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/2.png') }}"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 tab_data">
                                    <h3>{{$translate =App\Helpers\Menus::Translator(16,$code)}}</h3>
                                    <div class="tags">
                                        <span>{{$translate =App\Helpers\Menus::Translator(75,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(76,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(77,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(78,$code)}}</span>
                                    </div>
                                    <p>
                                        {{$translate =App\Helpers\Menus::Translator(72,$code)}} </p>
                                    <div class="row tab_row1">
                                        <div class="col-sm-1 nopad"><img
                                                    src="{{ asset('travel/images/image006.png') }}">
                                        </div>
                                        <div class="col-sm-7">
                                            <h5>{{$translate =App\Helpers\Menus::Translator(79,$code)}}</h5>
                                            <p>{{$translate =App\Helpers\Menus::Translator(80,$code)}}</p>
                                        </div>
                                        <div class="col-sm-4 pull-right right_text">Trip to Maldives</div>
                                    </div>
                                    <div class="row tab_row2">
                                        <div class="col-sm-4"><a href="#">Read Full Story</a></div>
                                        <div class="col-sm-8 nopad"><a href="#"
                                                                       class="btn1">{{$translate =App\Helpers\Menus::Translator(83,$code)}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tab5" class="tab-pane fade">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row slider_inside_tab slider_inside_tab5">
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/1.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/2.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/1.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/2.png') }}"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 tab_data">
                                    <h3>{{$translate =App\Helpers\Menus::Translator(16,$code)}}</h3>
                                    <div class="tags">
                                        <span>{{$translate =App\Helpers\Menus::Translator(75,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(76,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(77,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(78,$code)}}</span>
                                    </div>
                                    <p>{{$translate =App\Helpers\Menus::Translator(72,$code)}}</p>
                                    <div class="row tab_row1">
                                        <div class="col-sm-1 nopad"><img
                                                    src="{{ asset('travel/images/image006.png') }}">
                                        </div>
                                        <div class="col-sm-7">
                                            <h5>{{$translate =App\Helpers\Menus::Translator(79,$code)}}</h5>
                                            <p>{{$translate =App\Helpers\Menus::Translator(80,$code)}}</p>
                                        </div>
                                        <div class="col-sm-4 pull-right right_text">Trip to Maldives</div>
                                    </div>
                                    <div class="row tab_row2">
                                        <div class="col-sm-4"><a href="#">Read Full Story</a></div>
                                        <div class="col-sm-8 nopad"><a href="#"
                                                                       class="btn1">{{$translate =App\Helpers\Menus::Translator(83,$code)}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab6" class="tab-pane fade">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row slider_inside_tab slider_inside_tab6">
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/1.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/2.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/1.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/2.png') }}"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 tab_data">
                                    <h3>{{$translate =App\Helpers\Menus::Translator(16,$code)}}</h3>
                                    <div class="tags">
                                        <span>{{$translate =App\Helpers\Menus::Translator(75,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(76,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(77,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(78,$code)}}</span>
                                    </div>
                                    <p>{{$translate =App\Helpers\Menus::Translator(72,$code)}}</p>
                                    <div class="row tab_row1">
                                        <div class="col-sm-1 nopad"><img
                                                    src="{{ asset('travel/images/image006.png') }}">
                                        </div>
                                        <div class="col-sm-7">
                                            <h5>{{$translate =App\Helpers\Menus::Translator(79,$code)}}</h5>
                                            <p>{{$translate =App\Helpers\Menus::Translator(80,$code)}}</p>
                                        </div>
                                        <div class="col-sm-4 pull-right right_text">Trip to Maldives</div>
                                    </div>
                                    <div class="row tab_row2">
                                        <div class="col-sm-4"><a href="#">Read Full Story</a></div>
                                        <div class="col-sm-8 nopad"><a href="#"
                                                                       class="btn1">{{$translate =App\Helpers\Menus::Translator(83,$code)}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="tab7" class="tab-pane fade">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row slider_inside_tab slider_inside_tab7">
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/1.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/2.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/1.png') }}"></div>
                                        <div class="col-sm-6"><img src="{{ asset('travel/images/2.png') }}"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 tab_data">
                                    <h3>{{$translate =App\Helpers\Menus::Translator(16,$code)}}</h3>
                                    <div class="tags">
                                        <span>{{$translate =App\Helpers\Menus::Translator(75,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(76,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(77,$code)}}</span><span>{{$translate =App\Helpers\Menus::Translator(78,$code)}}</span>
                                    </div>
                                    <p>{{$translate =App\Helpers\Menus::Translator(72,$code)}}</p>
                                    <div class="row tab_row1">
                                        <div class="col-sm-1 nopad"><img
                                                    src="{{ asset('travel/images/image006.png') }}">
                                        </div>
                                        <div class="col-sm-7">
                                            <h5>{{$translate =App\Helpers\Menus::Translator(79,$code)}}</h5>
                                            <p>{{$translate =App\Helpers\Menus::Translator(80,$code)}}</p>
                                        </div>
                                        <div class="col-sm-4 pull-right right_text">Trip to Maldives</div>
                                    </div>
                                    <div class="row tab_row2">
                                        <div class="col-sm-4"><a href="#">Read Full Story</a></div>
                                        <div class="col-sm-8 nopad"><a href="#"
                                                                       class="btn1">{{$translate =App\Helpers\Menus::Translator(83,$code)}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        </div>
    </section>
    <section class="sec section perfect_holiday">
        <div class="container">
            <div class="row">
                <h3 class="common text-center">{{$translate =App\Helpers\Menus::Translator(17,$code)}}</h3>
                <p class="common text-center">{{$translate =App\Helpers\Menus::Translator(28,$code)}}</p>
            </div>
            <div class="row external_btns text-center">
                <div class="col-sm-4">
                    <a href="#selling">{{$translate =App\Helpers\Menus::Translator(84,$code)}}</a>
                </div>
                <div class="col-sm-4">
                    <a href="#packages">{{$translate =App\Helpers\Menus::Translator(85,$code)}}</a>
                </div>
                <div class="col-sm-4">
                    <a href="#get_a_free_quote">{{$translate =App\Helpers\Menus::Translator(86,$code)}}</a>
                </div>
            </div>
            <div class="row row_last_holidya_perfect">
                <div class="col-sm-6">
                    <h4>{{$translate =App\Helpers\Menus::Translator(24,$code)}}</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="{{ asset('travel/images/icon1.png') }}">
                            <h5>{{$translate =App\Helpers\Menus::Translator(87,$code)}}</h5>
                        </div>

                        <div class="col-sm-4">
                            <img src="{{ asset('travel/images/icon2.png') }}">
                            <h5>{{$translate =App\Helpers\Menus::Translator(88,$code)}}</h5>
                        </div>

                        <div class="col-sm-4">
                            <img src="{{ asset('travel/images/icon3.png') }}">
                            <h5>{{$translate =App\Helpers\Menus::Translator(89,$code)}}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <h4>{{$translate =App\Helpers\Menus::Translator(2,$code)}}</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="{{ asset('travel/images/icon4.png') }}">
                            <h5>{{$translate =App\Helpers\Menus::Translator(90,$code)}}</h5>
                        </div>

                        <div class="col-sm-4">
                            <img src="{{ asset('travel/images/icon5.png') }}">
                            <h5>{{$translate =App\Helpers\Menus::Translator(91,$code)}}</h5>
                        </div>

                        <div class="col-sm-4">
                            <img src="{{ asset('travel/images/icon6.png') }}">
                            <h5>{{$translate =App\Helpers\Menus::Translator(92,$code)}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container simple_filters" id="packages">
            <div class="row">
                <h3 class="common text-center">{{$translate =App\Helpers\Menus::Translator(20,$code)}}</h3>
                <p class="common text-center">{{$translate =App\Helpers\Menus::Translator(29,$code)}}</p>
            </div>
            <div class="all_destinations">
                <h4>{{$translate =App\Helpers\Menus::Translator(30,$code)}}</h4>
                <div class="price_main_wrap  nav nav-tabs">
                    <div class="days_limit price"><a class="filter" data-value="0-10000">Less than Aed 10,000</a></div>
                    <div class="days_limit price"><a class="filter" data-value="10000-20000">Aed 10,000 to Aed
                            20,000</a>
                    </div>
                    <div class="days_limit price"><a class="filter" data-value="20000-40000">Aed 20,000 to Aed
                            40,000</a>
                    </div>
                    <div class="days_limit price"><a class="filter" data-value="40000-60000">Aed 40,000 to Aed
                            60,000</a>
                    </div>
                    <div class="days_limit price"><a class="filter" data-value="60000-80000">Aed 60,000 to Aed
                            80,000</a>
                    </div>
                    <div class="days_limit price"><a class="filter" data-value="80000-1000000000000">Above Aed
                            80,000</a>
                    </div>
                </div>

                <div>
                    <div id="explore_10_less">
                        <div class="total_packges_with_slider">
                            <div class="sec_red_price">You have {{count($package)}} packages</div>
                            <div class="view_all"><a
                                        href="#">{{$translate =App\Helpers\Menus::Translator(109,$code)}}</a></div>
                            <div class="slider_red_price row packages-view">
                                @include('Frontend/snippets/search-price')
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="text-center">
                <img class="full_width" src="{{ asset('travel/images/honeymoon_small.png') }}">
            </div>
            <div class="slider_red_2">
                <div class="all_destinations">
                    <h4>{{$translate =App\Helpers\Menus::Translator(18,$code)}}</h4>
                    <div class="best_main_wrap nav nav-tabs">
                        <!-- <input type="checkbox" class="days_limit ">
                            <a class="filter" data-value="1-3">1 to 3 Days </a>
                            </input> -->
                        <div type="radio" class="days_limit best"><a class="filter"
                                                                     data-value="1-3">{{$translate =App\Helpers\Menus::Translator(52,$code)}}</a>
                        </div>
                        <div type="radio" class="days_limit best"><a class="filter"
                                                                     data-value="4-6">{{$translate =App\Helpers\Menus::Translator(53,$code)}}</a>
                        </div>
                        <div type="radio" class="days_limit best"><a class="filter"
                                                                     data-value="7-9">{{$translate =App\Helpers\Menus::Translator(54,$code)}}</a>
                        </div>
                        <div type="radio" class="days_limit best"><a class="filter"
                                                                     data-value="10-12">{{$translate =App\Helpers\Menus::Translator(55,$code)}}</a>
                        </div>
                        <div type="radio" class="days_limit best"><a class="filter"
                                                                     data-value="13-100">{{$translate =App\Helpers\Menus::Translator(56,$code)}}</a>
                        </div>
                    </div>
                    <div>
                        <div id="duration_1">
                            <div class="">
                                <div class="sec_red_price">You have {{count($package)}} packages</div>
                                <div class="view_all"><a
                                            href="#">{{$translate =App\Helpers\Menus::Translator(109,$code)}}</a></div>
                                <div class=" row packages-view slider_red_price">
                                    @include('Frontend/snippets/search-best')
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- sec -->
            <h4 class="select_travel_month_heading">{{$translate =App\Helpers\Menus::Translator(31,$code)}}</h4>
            <h5 class=""><span>{{$translate =App\Helpers\Menus::Translator(93,$code)}}</span></h5>
            <div class="all_destinations">
                {{-- <div class="select_travel_month_below"><span>Select your month of Travel</span>

                            <span class="month_main_wrap nav nav-tabs">
                                <a data-toggle="tab" class="month" href="#jan"><input type="radio" name="month_travel"
                                        class="filter" data-value="Jan-Feb-Mar"> <label>Jan-Feb-Mar</label></a>
                                <a data-toggle="tab" class="month" href="#apr"><input type="radio" name="month_travel"
                                        class="filter" data-value="Apr-May-Jun"> <label>Apr-May-Jun</label></a>
                                <a data-toggle="tab" class="month" href="#jul"><input type="radio" name="month_travel"
                                        class="filter" data-value="Jul-Aug-Sep"> <label>Jul-Aug-Sep</label></a>
                                <a data-toggle="tab" class="month" href="#oct"><input type="radio" name="month_travel"
                                        class="filter" data-value="Oct-Nov-Dec"> <label>Oct-Nov-Dec</label></a>
                            </span>
                        </div> --}}


                <div class="month_main_wrap best_main_wrap nav nav-tabs">
                    <div type="radio" class="month days_limit"><a class="filter"
                                                                  data-value="Jan-Feb-Mar">Jan-Feb-Mar</a></div>
                    <div type="radio" class="month days_limit"><a class="filter"
                                                                  data-value="Apr-May-Jun">Apr-May-Jun</a></div>
                    <div type="radio" class="month days_limit"><a class="filter"
                                                                  data-value="Jul-Aug-Sep">Jul-Aug-Sep</a></div>
                    <div type="radio" class="month days_limit"><a class="filter"
                                                                  data-value="Oct-Nov-Dec">Oct-Nov-Dec</a>
                    </div>
                </div>


                <div style="
                margin-top: 3em;
            ">
                    <div id="jan">
                        <div class="row packages-view slider_red_price">
                            @include('Frontend/snippets/search-month')
                        </div>
                    </div>

                </div>
            </div>
            <div class="themes_sec">
                <h6>Still undecided?</h6>
                <h4 class="select_travel_month_heading">{{$translate =App\Helpers\Menus::Translator(15,$code)}}</h4>

                <div class="row text-center row_themes">
                    @if(isset($activities))
                        @foreach ($activities as $activity)
                            <div class="col-sm-3">
                                <a class="themes_sec_inner"
                                   href="{{url('tour-packages')}}?lang={{$code ?? ''}}&activities={{$activity->slug}}">
                                    @if ($activity->image != null)
                                        @php $image = $activity->image @endphp
                                    @else
                                        @php $image = 'galleryimage.png' @endphp
                                    @endif
                                    <img src="{{ asset('images/media' . '/' . $image) }}">
                                    <p><strong>{{ $activity->title ?? ''}}</strong>
                                        <br>{{$translate =App\Helpers\Menus::Translator(94,$code)}}</p>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            {{-- <h4>Out-of-the-box holiday packages</h4> --}}
            {{-- <div class="slider_red_price row"> --}}
            {{-- <div class="col-sm-4"> --}}
            {{-- <div class="red_slide_image"> --}}
            {{-- <img src="{{ asset('travel/images/canareef_pic.png') }}"><a --}} {{--                            class="see-details-button absolute-center" href="#">View Packages</a> --}} {{--                        <div class="slide_text_pkg">Maldives <span>(5 Days & 4 Nights)</span></div> --}} {{--                        <div class="red_bar_top">Expert’s Pick</div> --}} {{--                    </div> --}} {{--                    <div class="row"> --}} {{--                        <div class="col-sm-12"> --}} {{--                            <div class="title_red_slider">Summer Special Dubai Holiday</div> --}} {{--                        </div> --}} {{--                    </div> --}} {{--                </div> --}} {{--                <div class="col-sm-4"> --}} {{--                    <div class="red_slide_image"> --}} {{--                        <img src="{{ asset('travel/images/aerial_view_ofdubai.png') }}"><a --}} {{--                            class="see-details-button absolute-center" href="#">View Packages</a> --}} {{--                        <div class="slide_text_pkg">Dubai <span>(6 Days & 5 Nights)</span></div> --}} {{--                        <div class="red_bar_top">Expert’s Pick</div> --}} {{--                    </div> --}} {{--                    <div class="row"> --}} {{--                        <div class="col-sm-12"> --}} {{--                            <div class="title_red_slider">Paradisiacal Himachal Family Tour Package</div> --}} {{--                        </div> --}} {{--                    </div> --}} {{--                </div> --}} {{--                <div class="col-sm-4"> --}} {{--                    <div class="red_slide_image"> --}} {{--                        <img src="{{ asset('travel/images/dolphinarium.png') }}"><a --}} {{--                            class="see-details-button absolute-center" href="#">View Packages</a> --}} {{--                        <div class="slide_text_pkg">Dubai <span>(7 Days & 6 Nights)</span></div> --}} {{--                        <div class="red_bar_top">Expert’s Pick</div> --}} {{--                    </div> --}} {{--                    <div class="row"> --}} {{--                        <div class="col-sm-12"> --}} {{--                            <div class="title_red_slider">Bestselling Maldives Honeymoon Tour Package</div> --}} {{--                        </div> --}} {{--                    </div> --}} {{--                </div> --}} {{--                <div class="col-sm-4"> --}} {{--                    <div class="red_slide_image"> --}} {{--                        <img src="{{ asset('travel/images/aerial_view_ofdubai.png') }}"><a --}} {{--                            class="see-details-button absolute-center" href="#">View Packages</a> --}} {{--                        <div class="slide_text_pkg">Dubai <span>(6 Days & 5 Nights)</span></div> --}} {{--                        <div class="red_bar_top">Expert’s Pick</div> --}} {{--                    </div> --}} {{--                    <div class="row"> --}} {{--                        <div class="col-sm-12"> --}} {{--                            <div class="title_red_slider">Summer Special Dubai Holiday</div> --}} {{--                        </div> --}} {{--                    </div> --}} {{--                </div> --}} {{--            </div> --}}
        </div>
    </section>
    <section class="sec section sec_excerpt" id="get_a_free_quote">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 text-center">
                    <img src="{{ asset('travel/images/feeling_lost.png') }}">
                    <h1>{{$translate =App\Helpers\Menus::Translator(34,$code)}}</h1>
                    <p>{{$translate =App\Helpers\Menus::Translator(35,$code)}}</p>
                </div>

                <div class="col-sm-6">
                    @include('Frontend/snippets/form-package')

                </div>


                <!-- Circles which indicates the steps of the form: -->
                <!-- <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                </div> -->


            </div>

        </div>

    </section>
    <section class="sec section safe_holidays">
        <div class="container">
            <h4 class="common">{{$translate =App\Helpers\Menus::Translator(36,$code)}}</h4>
            <p class="common2">{{$translate =App\Helpers\Menus::Translator(37,$code)}}</p>
            <div class="row">
                @if(isset($holidays))
                    @foreach ($holidays as $holiday)
                        <div class="col-sm-3 commitment-desc">
                            @if ($holiday->image != null)
                                @php $image = $holiday->image @endphp
                            @else
                                @php $image = 'galleryimage.png' @endphp
                            @endif
                            <img src="{{ asset('images/media' . '/' . $image) }}">
                            <h5>{{ $holiday->title }}</h5>
                            <p>{!! $holiday->description !!}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <section class="sec section text-center generic_large">
        <div class="container">
            <a href="{{url('tour-packages')}}?lang={{$code}}"><img src="{{ asset('travel/images/generic-large.png') }}"
                                                                   class="full_width"></a>
        </div>
    </section>
    <section class="sec section incredibly_sec">
        <div class="container">

            <div class="row incredibly_text">
                <div class="col-sm-8">
                    <h3>{{$translate =App\Helpers\Menus::Translator(38,$code)}}</h3>
                    <p>{{$translate =App\Helpers\Menus::Translator(39,$code)}}</p>
                </div>
                <div class="col-sm-4 text-right">
                    <a href="{{url('https://client.edwomtech.com/dopaminetravel_wp/')}}">{{$translate =App\Helpers\Menus::Translator(109,$code)}}</a>
                </div>
            </div>

            <div class="row incredibly_slider text-center">
                @foreach($blogs as $blog)
                    <div class="col-sm-4 getwayslider">
                        <div class="incredibly_slider_inner">
                            <img src="{{$blog->thumbnail_url}}">
                            <h4>{{$blog->title}}</h4>
                            <p class="pull-right">
                                <a href="#">{{$translate =App\Helpers\Menus::Translator(111,$code)}}</a>
                            </p>
                        </div>
                    </div>
            @endforeach

            <!-- <div class="col-sm-4">
                    <div class="incredibly_slider_inner">
                        <img src="{{ asset('travel/images/incredibly.png') }}">
                        <h4>{{$translate =App\Helpers\Menus::Translator(110,$code)}}</h4>
                        <p class="pull-right">
                            <a href="#">{{$translate =App\Helpers\Menus::Translator(111,$code)}}</a>
                        </p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="incredibly_slider_inner">
                        <img src="{{ asset('travel/images/incredibly.png') }}">
                        <h4>{{$translate =App\Helpers\Menus::Translator(110,$code)}} </h4>
                        <p class="pull-right">
                            <a href="#">{{$translate =App\Helpers\Menus::Translator(111,$code)}}</a>
                        </p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="incredibly_slider_inner">
                        <img src="{{ asset('travel/images/incredibly.png') }}">
                        <h4>50 Incredibly Romantic Honeymoon Destinations </h4>
                        <p class="pull-right">
                            <a href="#">{{$translate =App\Helpers\Menus::Translator(111,$code)}}</a>
                        </p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="incredibly_slider_inner">
                        <img src="{{ asset('travel/images/incredibly.png') }}">
                        <h4>50 Incredibly Romantic Honeymoon Destinations </h4>
                        <p class="pull-right">
                            <a href="#">{{$translate =App\Helpers\Menus::Translator(111,$code)}}</a>
                        </p>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <section class="sec section get_explore">
        <div class="row">
            <div class="col-sm-8">

                <h3>{{$translate =App\Helpers\Menus::Translator(40,$code)}}</h3>
                <p>{{$translate =App\Helpers\Menus::Translator(41,$code)}}</p>
            </div>
            <div class="col-sm-4">
                <a href="#">{{$translate =App\Helpers\Menus::Translator(112,$code)}}</a>
            </div>
        </div>

    </section>
    <section class="sec section who_we_are">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-left">
                    <h3>{{$translate =App\Helpers\Menus::Translator(42,$code)}}</h3>
                    <p>{{$translate =App\Helpers\Menus::Translator(113,$code)}}<span id="dots">...</span></p>
                    <div id="more">
                        <p>{{$translate =App\Helpers\Menus::Translator(114,$code)}}</p>

                        <p>{{$translate =App\Helpers\Menus::Translator(115,$code)}}</p>

                        <p>{{$translate =App\Helpers\Menus::Translator(116,$code)}}</p>

                        <p>{{$translate =App\Helpers\Menus::Translator(117,$code)}}</p>

                        <p>{{$translate =App\Helpers\Menus::Translator(118,$code)}}</p>
                    </div>
                    <p class="pull-right"><a href="#" id="myBtn"
                                             onclick="readmore()">{{$translate =App\Helpers\Menus::Translator(111,$code)}}</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    </div>
    <div class="vertical_page_tabing">
        <a href="#explore">Explore</a>
        <a href="#destinations">Destinations</a>
        <a href="#travel_stories">Travel Stories</a>
        <a href="#packages">Packages</a>
        <a href="#get_a_free_quote">Get a Free Quote</a>
    </div>
    <input type="hidden" name="lang_id" id="language_id" value="{{ $language->id ?? ''}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>-->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script> -->
    <script>
        $(".submit-form").click(function () {
            $('.vvvv').html("");
            var sell_for = $("input[name='sell_for']:checked").map(function (item) {
                return $(this).val();
            }).get();
            var lang_id = $('#language_id').val();
            console.log(sell_for, lang_id);
            $.ajax({
                type: 'GET',
                url: "{{url('destination')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'sell_for': sell_for,
                    'lang_id': lang_id,
                },
                contentType: "application/json",
                success: function (data) {
                    $('.slider_destinations').slick('unslick');
                    $('.vvvv').html(data);

                    setTimeout(function () {
                        $('.slider_destinations').slick({
                            slidesToShow: 6,
                            slidesToScroll: 1,
                            arrows: true,
                            autoplay: true,
                            responsive: [{
                                breakpoint: 1100,
                                settings: {
                                    slidesToShow: 5,
                                    slidesToScroll: 1,
                                    infinite: true,
                                    dots: true
                                }
                            },
                                {
                                    breakpoint: 800,
                                    settings: {
                                        slidesToShow: 4,
                                        slidesToScroll: 1
                                    }
                                },
                                {
                                    breakpoint: 480,
                                    settings: {
                                        slidesToShow: 1,
                                        slidesToScroll: 1
                                    }
                                }
                            ]

                        });
                    }, 500);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            const select = document.querySelector('#option');
            const form = document.querySelector('form');
            // const month = document.querySelector('.select_month');

            select.addEventListener('change', function () {
                const selectedValue = select.value;
                form.action = `tour-package/${selectedValue}`;
            });

            // month.addEventListener('change', function () {
            //     form.action = `${form.action}?month=${month.value}`;
            // });

            $(document).on('click', '.filter', function () {
                $(this).parents('.all_destinations').find('.days_limit').removeClass('active');
                $(this).parents('.days_limit').addClass('active');
                // $(this).parents('.all_destinations').find('.packages-view div').css({'opacity':'0'})
                console.log(
                    "eeeeeeeeeeeeeeeeeee"
                )
                // this.closest('.all_destinations').querySelector('.packages-view div').style.opacity = 0;

                // console.log( this.closest('.all_destinations').querySelector('.packages-view div, .packages-view button'));

                $(this).parents('.all_destinations').find('.packages-view').html(`<div class="col-12 py-4 text-center" style="
    padding-block: 2em;
">
<div role="status" class="spinner-border" style="
    width: 30px;
    height: 30px;
    color: #e6542d;
">
  <span class="visually-hidden">Loading...</span>
</div>
</div>`);
                var $value1 = null;
                var $value2 = null;
                var $value3 = null;
                var $value4 = null;
                var $lang_id = $('#language_id').val();
                if ($(this).parents('.price_main_wrap').find('.price').length) {
                    $value1 = $(this).data('value');
                }
                if ($(this).parents('.month_main_wrap').find('.month').length) {
                    $value2 = $(this).data('value');
                }
                if ($(this).parents('.best_main_wrap').find('.best').length) {
                    $value3 = $(this).data('value');
                }
                if ($(this).parents('.days_main_wrap').find('.selling').length) {
                    $value4 = $(this).data('value');
                }

                var itt = this;
                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                // });

                $.ajax({
                    type: 'GET',
                    url: "{{ url('filter') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'search_price': $value1,
                        'search_month': $value2,
                        'search_best': $value3,
                        'search_selling': $value4,
                        'lang_id': $lang_id,
                    },
                    contentType: "application/json",
                    success: function (data) {
                        if (data === '') {
                            $(itt).parents('.all_destinations').find('.packages-view').html(`<div class="p48 sbc5"><span class="relative block mauto text-center css-23ymlk"><svg viewBox="0 0 63.01 65.58" class="icon shape-codepen svg"><use xlink:href="/travel/v3/public/travel/icons-svg-4836ed122c3cd7188fd9302961613cec.svg#LookingIcon-usage"></use></svg></span><p class="f16p fw9 mt15 mb0 text-center">Couldn't find any destination. Try other duration.</p></div>`);
                        } else {
                            $(itt).parents('.all_destinations').find('.packages-view').html(data);
                        }
                    },
                    error: function (err) {
                        console.error(err)
                    }

                });
            });
        });
    </script>


    <script type="text/javascript">
        jQuery('.select_travel_month_below a').click(function () {

            // jQuery(this).addClass('hli').find('input').prop('checked', true)
        });
        jQuery(document).ready(function () {
            jQuery(".int_destinations").click(function () {
                jQuery(".aaaaaaaa").show();
                // jQuery(".destinations_within_uae").hide();
                // jQuery(".internationa_destinations").show();
                // jQuery(this).addClass('hlii').find('input').prop('checked', true)
            });
            jQuery(".dest_within_uae").click(function () {
                jQuery(".aaaaaaaa").show();
                // jQuery(".internationa_destinations").hide();
                // jQuery(".destinations_within_uae").show();
                // jQuery(this).addClass('hlii').find('input').prop('checked', true)
            });

            // jQuery(".has-sub > a").append('<i class="fa fa-chevron-down"></i>');
            // jQuery(".sec_excerpt .submit").append('<i class="fa fa-chevron-right"></i>');
        });
        var coll = document.getElementsByClassName("collapsible");
        var i;
        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function () {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
            });
        }
        jQuery("document").ready(function () {
            jQuery(".collapsible").trigger('click');
        });
    </script>
    <script>
        function readmore() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("myBtn");

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Read more";
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = "Read less";
                moreText.style.display = "inline";
            }
        }
    </script>
    <!-- <script>
            const dropdown = document.querySelector('.multi-select-dropdown');
            const selectedOptions = dropdown.querySelector('.selected-options');
            const selectedOptionList = dropdown.querySelector('.selected-option-list');
            const options = dropdown.querySelectorAll('.options li');
            const hiddenInput = dropdown.querySelector('input[type="hidden"]');

            selectedOptions.addEventListener('click', () => {
                dropdown.classList.toggle('open');
            });

            options.forEach(option => {
                const checkbox = option.querySelector('input[type="checkbox"]');
                checkbox.addEventListener('change', () => {
                    if (checkbox.checked) {
                        const selectedOption = document.createElement('div');
                        selectedOption.classList.add('selected-option');
                        selectedOption.textContent = option.textContent;
                        selectedOptionList.appendChild(selectedOption);
                    } else {
                        const selectedOption = selectedOptionList.querySelector(`div[data-value="${option.value}"]`);
                        selectedOption.remove();
                    }
                    const selectedValues = Array.from(options)
                        .filter(option => option.querySelector('input[type="checkbox"]').checked)
                        .map(option => option.querySelector('input[type="checkbox"]').value);
                    hiddenInput.value = selectedValues.join(',');
                });
            });
        </script> -->
    <script>
        const dropdown = document.querySelector('.multi-select-dropdown');
        const selectedOptions = dropdown.querySelector('.selected-options');
        const selectedOptionList = dropdown.querySelector('.selected-option-list');
        const options = dropdown.querySelectorAll('.options li');
        const hiddenInput = dropdown.querySelector('input[type="hidden"]');

        selectedOptions.addEventListener('click', () => {
            dropdown.classList.toggle('open');
        });

        options.forEach(option => {
            const checkbox = option.querySelector('input[type="checkbox"]');

            checkbox.addEventListener('change', () => {
                if (checkbox.checked) {
                    document.getElementById('selectop-none').style.display = "none";
                    document.getElementById('padding-0').style.padding = "0px";
                    // selectedOptionList.style.padding = "0px";

                    const selectedOption = document.createElement('div');
                    selectedOption.classList.add('selected-option1');
                    selectedOption.dataset.value = checkbox.value;
                    selectedOption.textContent = checkbox.value;
                    selectedOptionList.appendChild(selectedOption);
                } else {
                    const selectedOption = selectedOptionList.querySelector(`div[data-value="${checkbox.value}"]`);
                    selectedOption.remove();
                }
                const selectedValues = Array.from(options)
                    .filter(option => option.querySelector('input[type="checkbox"]').checked)
                    .map(option => option.querySelector('input[type="checkbox"]').value);
                hiddenInput.value = selectedValues.join(',');
            });
        });
    </script>


@endsection
