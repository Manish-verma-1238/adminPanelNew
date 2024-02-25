<style>
    @media only screen and (min-width: 769px) {
        .pac-container {
            border-radius: 5px;
            padding: 5px;
            margin-top: -155px;
        }
    }

    @media (max-width: 768px) {
        .pac-container {
            margin-top: -82px;
        }
    }

    .pac-container:after {
        content: none !important;
    }

    .pac-item,
    .pac-item-query {
        font-size: 1em;
        font-family: 'Nunito Sans', sans-serif;
    }

    html {
        scroll-behavior: smooth;
    }

    .country-form-control {
        display: block;
        width: 100%;
        height: auto;
        padding: 15px 19px;
        font-size: 1rem;
        line-height: 1.4;
        color: white;
        background: none;
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: 1px solid #ffffff;
        transition: 0.2s;
    }

    .country-form-control:focus {
        color: white;
        background: none;
        border: 1px solid var(--main-color);
        outline: 0;

        .country-form-control::placeholder {
            color: var(--main-color);
        }
    }

    .country-form-control::placeholder {
        color: white;
    }

    .intl-tel-input,
    .iti {
        width: 100%;
    }

    .iti {
        width: 100%;
        /* Adjust the width as needed */
    }

    .iti__selected-flag {
        width: auto;
        /* Ensure the flag size is appropriate */
    }

    .iti__selected-dial-code {
        color: #ffffff !important;
        display: inline-block;
        margin-left: 5px;
    }

    aside:before,
    aside:after {
        height: 0;
        width: 0;
        content: '';
        position: absolute;
        border-style: solid;
        border-width: 0;
    }

    aside {
        padding: 5px 0;
        position: relative;
    }

    /* Ribbon2 specific styles */
    aside.ribbon2 {
        background-color: black;
        color: var(--main-color);
    }

    aside.ribbon2:before,
    aside.ribbon2:after {
        top: 3px;
    }

    aside.ribbon2:before {
        border-color: black black black transparent;
        left: -33px;
        border-width: 17px;
    }

    aside.ribbon2:after {
        border-color: black transparent black black;
        right: -33px;
        border-width: 17px;
    }

    /* selectbox */
    #mySelect {
        color: white;
        background: none;
        height: 53px;

        option {
            color: black;
        }

        .choices__list--dropdown .choices__item--selectable {
            padding-right: 1rem;
        }

        .choices__list--single {
            padding: 0;
        }

        .card {
            transform: translateY(-50%);
        }

        .choices[data-type*=select-one]:after {
            right: 1.5rem;
        }

        .shadow {
            box-shadow: 0.3rem 0.3rem 1rem rgba(178, 200, 244, 0.23);
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: all 0.3s;
        }
    }

    /* selectbox */

    .modelboxcong {
        vertical-align: middle;
        display: flex;


        .card {
            border-radius: 3vh;
            margin: auto;
            max-width: 380px;
            padding: 7vh 6vh;
            align-items: center;
            box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        @media(max-width:767px) {
            .card {
                width: 90vw;
            }
        }

        .card-img {
            padding: 20px 0;
            width: 40%;
        }

        .card-img img {
            opacity: 0.7;
        }

        .card-title {
            margin-bottom: unset;
        }

        .card-title p {
            color: rgb(29, 226, 226);
            font-weight: 900;
            font-size: 30px;
            margin-bottom: unset;
        }

        .card-text p {
            color: grey;
            font-size: 25px;
            text-align: center;
            padding: 3vh 0;
            font-weight: lighter;
        }

        .btn {
            width: 100%;
            background-color: rgb(29, 226, 226);
            border-color: rgb(29, 226, 226);
            border-radius: 25px;
            color: white;
            font-size: 15px;
        }

        .modal-header .close {
            padding: 1rem 1rem;
            margin: 0rem 0rem 0rem auto !important;
            background: black !important;
            color: white !important;
        }

        .modal-content {
            position: relative;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: transparent !important;
            background-clip: padding-box;
            border: none !important;
            border-radius: 0.3rem;
            outline: 0;
        }

        .modal-header {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: start;
            align-items: flex-start;
            -ms-flex-pack: justify;
            justify-content: space-between;
            padding: 1rem 1rem;
            border-bottom: none !important;
            border-top-left-radius: calc(0.3rem - 1px);
            border-top-right-radius: calc(0.3rem - 1px);
        }

        #termsDiv {
            position: relative;
        }

        #termsCheckbox {
            position: absolute;
            left: 30px !important;
            border: 3px solid #73AD21;
        }
    }
</style>