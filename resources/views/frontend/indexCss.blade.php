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
</style>