<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IDPREV - Defendendo seus direitos.</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- NAVBAR -->
    <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-gray-200">
        <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center">
                <img src="{{ asset('images/logotipo.png') }}" class="h-8" alt="Logotipo IDPREV">
            </a>
            <div class="flex md:order-2">
                <a href="/login"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Área
                    do Franqueado</a>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            </div>
        </div>
    </nav>
    <!-- END AVBAR -->

    <!-- BANNER -->
    <section
        class="bg-center bg-no-repeat bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/conference.jpg')] bg-gray-700 bg-blend-multiply mt-20">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center md:pt-24 md:pb-8">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl">
                Somos a maior rede previdenciária do Brasil.</h1>
            <p class="mb-8 text-lg font-normal text-white lg:text-3xl sm:px-16 lg:px-48">
                Mais de 10 anos de mercado e 14 mil clientes satisfeitos.</p>
        </div>

        <div class="max-w-screen-xl flex flex-col mx-auto md:flex-row">

            <div class="p-6 md:flex-1">
                <ul class="space-y-1 text-left text-white text-2xl">
                    <li class="flex items-center space-x-3">
                        <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5.917 5.724 10.5 15 1.5" />
                        </svg>
                        <span>Aposentadorias</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5.917 5.724 10.5 15 1.5" />
                        </svg>
                        <span>Pensões</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5.917 5.724 10.5 15 1.5" />
                        </svg>
                        <span>Loas</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5.917 5.724 10.5 15 1.5" />
                        </svg>
                        <span>Revisões</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5.917 5.724 10.5 15 1.5" />
                        </svg>
                        <span>Auxílios</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5.917 5.724 10.5 15 1.5" />
                        </svg>
                        <span>Fraudes com empréstimo consignado</span>
                    </li>
                </ul>
            </div>

            <div class="flex justify-center p-6 md:flex-1 md:justify-end">
                <div>
                    <h3 class="mb-3 text-2xl font-semibold text-white">O INSS negou seu pedido?</h3>
                    <h3 class="mb-3 text-2xl font-semibold text-white">Dúvidas ou problemas com o INSS?</h3>
                    <p class="mb-3 font-normal text-white">Resolvemos seu problema em todo o Brasil.
                    </p>
                    <a href="#"
                        class="block p-3 text-md font-normal text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Resolva seu problema com o INSS aqui.
                    </a>
                    <a href="https://instagram.com/idprevofc?igshid=YmMyMTA2M2Y=" target="_blank"
                        class="mt-5 block w-12 rounded-md">
                        <img src="{{ asset('images/icon-instagram.svg') }}" alt="Instagram IDPREV" />
                    </a>
                </div>

            </div>

        </div>
    </section>
    <!-- AND BANNER -->

    <section class="max-w-screen-xl flex gap-5 flex-col m-5 my-10 md:p-5 md:mx-auto md:flex-row">

        <div class="flex-1">
            <h1 class="text-4xl font-bold mb-5 uppercase">Seja nosso franqueado e <span class="text-blue-500">receba
                    clientes</span> todos os dias.</h1>
            <p class="mb-5 text-2xl text-gray-500">A melhor franquia para qualquer pessoa que queira ganhar dinheiro com
                a maior área do Direito no Brasil.</p>
            <ul class="space-y-1 text-gray-500 list-inside mb-5">
                <li class="flex items-center">
                    <svg class="w-3.5 h-3.5 mr-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    Primeira e única rede previdenciária do Brasil.
                </li>
                <li class="flex items-center">
                    <svg class="w-3.5 h-3.5 mr-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    Desde 2012 com mais de 14 mil clientes.
                </li>
                <li class="flex items-center">
                    <svg class="w-3.5 h-3.5 mr-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    Baixo investimento e alta rentabilidade.
                </li>
                <li class="flex items-center">
                    <svg class="w-3.5 h-3.5 mr-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    Plataforma própria com gestão simplificada.
                </li>
                <li class="flex items-center">
                    <svg class="w-3.5 h-3.5 mr-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    Clientes, advogados especializados, despachantes, peritos, marketing digital, assessoria
                    especializada, tudo incluso e sem custo adicional.
                </li>

            </ul>

        </div>

        <div class="flex-1">
            <video class="w-full h-auto max-w-full border border-gray-200 rounded-lg dark:border-gray-700" controls>
                <source src="{{ asset('images/institucional.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

    </section>

    <!-- PUBLICIDADE -->
    <section class="bg-white mb-10">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center md:py-10">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl">
                A melhor franquia para advogados, contadores, bacharéis ou qualquer
                pessoa que queira ganhar dinheiro com o INSS.</h1>
            <p class="mb-8 text-lg font-normal text-gray-500 sm:px-16 md:text-3xl md:px-48">
                Sem necessidade de ter OAB ou experiência na área previdenciária,
                prestamos total suporte.</p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                <a href="https://wa.me/5511914080948" target="_blank"
                    class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    QUERO SER UM FRANQUEADO DE SUCESSO.
                    <img src="{{ asset('images/icon-whatsapp.svg') }}" alt="Whatsapp IDPREV" class="ml-2" />
                </a>
            </div>
        </div>
    </section>

    <!-- AND PUBLICIDADE -->

    <!-- TESTEMUNHAS -->
    <section class="max-w-screen-xl flex flex-col m-5 my-10 md:p-5 md:mx-auto md:flex-row">
        <div
            class="grid mb-8 border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 md:mb-12 md:grid-cols-2">
            <figure
                class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 rounded-t-lg md:rounded-t-none md:rounded-tl-lg md:border-r dark:bg-gray-800 dark:border-gray-700">
                <blockquote class="max-w-2xl mx-auto mb-4 text-gray-500 lg:mb-8 dark:text-gray-400">
                    <p class="my-4">If you care for your time, I hands down would go with this."</p>
                </blockquote>
                <figcaption class="flex items-center justify-center space-x-3">
                    <img class="rounded-full w-9 h-9"
                        src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/karen-nelson.png"
                        alt="profile picture">
                    <div class="space-y-0.5 font-medium dark:text-white text-left">
                        <div>Bonnie Green</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Developer at Open AI</div>
                    </div>
                </figcaption>
            </figure>
            <figure
                class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 rounded-tr-lg dark:bg-gray-800 dark:border-gray-700">
                <blockquote class="max-w-2xl mx-auto mb-4 text-gray-500 lg:mb-8 dark:text-gray-400">
                    <p class="my-4">Designing with Figma components that can be easily translated to the utility
                        classes of Tailwind CSS is a huge timesaver!"</p>
                </blockquote>
                <figcaption class="flex items-center justify-center space-x-3">
                    <img class="rounded-full w-9 h-9"
                        src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/roberta-casas.png"
                        alt="profile picture">
                    <div class="space-y-0.5 font-medium dark:text-white text-left">
                        <div>Roberta Casas</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Lead designer at Dropbox</div>
                    </div>
                </figcaption>
            </figure>
            <figure
                class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 rounded-bl-lg md:border-b-0 md:border-r dark:bg-gray-800 dark:border-gray-700">
                <blockquote class="max-w-2xl mx-auto mb-4 text-gray-500 lg:mb-8 dark:text-gray-400">
                    <p class="my-4">Aesthetically, the well designed components are beautiful and will undoubtedly
                        level up your next application."</p>
                </blockquote>
                <figcaption class="flex items-center justify-center space-x-3">
                    <img class="rounded-full w-9 h-9"
                        src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"
                        alt="profile picture">
                    <div class="space-y-0.5 font-medium dark:text-white text-left">
                        <div>Jese Leos</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Software Engineer at Facebook</div>
                    </div>
                </figcaption>
            </figure>
            <figure
                class="flex flex-col items-center justify-center p-8 text-center bg-white border-gray-200 rounded-b-lg md:rounded-br-lg dark:bg-gray-800 dark:border-gray-700">
                <blockquote class="max-w-2xl mx-auto mb-4 text-gray-500 lg:mb-8 dark:text-gray-400">
                    <p class="my-4">You have many examples that can be used to create a fast prototype for your
                        team."</p>
                </blockquote>
                <figcaption class="flex items-center justify-center space-x-3">
                    <img class="rounded-full w-9 h-9"
                        src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/joseph-mcfall.png"
                        alt="profile picture">
                    <div class="space-y-0.5 font-medium dark:text-white text-left">
                        <div>Joseph McFall</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">CTO at Google</div>
                    </div>
                </figcaption>
            </figure>
        </div>


    </section>
    <!-- END TESTEMINHAS -->

    <!-- FOOTER -->

    <footer class="bg-blue-900">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">

                    <a href="https://instagram.com/idprevofc?igshid=YmMyMTA2M2Y=" target="_blank"
                        class="flex items-center">
                        <img src="{{ asset('images/icon-instagram.svg') }}" alt="Instagram IDPREV" />
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-6 text-2xl font-semibold text-white uppercase">Contato</h2>
                        <ul class="text-gray-400 font-normal">
                            <li>
                                <a href="/" class="hover:underline">Matriz - Maceió/AL</a>
                            </li>
                            <li>
                                <a href="/" class="hover:underline">Digital - São Paulo/SP</a>
                            </li>
                            <li>
                                <a href="/" class="hover:underline">falecom@idprev.com.br</a>
                            </li>
                            <li>
                                <a href="/" class="hover:underline">+55 82 3435-9092</a>
                            </li>
                            <li>
                                <a href="/" class="hover:underline">+55 11 91408-0948</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-2xl font-semibold text-white uppercase">Suporte</h2>
                        <ul class="text-gray-400 font-normal">
                            <li>
                                <a href="/login" class="hover:underline">Área do Franqueado</a>
                            </li>
                            <li>
                                <a href="/" class="hover:underline">Seja um franqueado de sucesso</a>
                            </li>
                            <li>
                                <a href="/" class="hover:underline">Resolva seu problema ocm o INSS</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-2xl font-semibold text-white uppercase">Programador</h2>
                        <ul class="text-gray-400 font-normal">
                            <li class="mb-4">
                                <a href="/" class="hover:underline">Denis Buarque</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="sm:flex sm:items-center sm:justify-between mt-5">
                <span class="text-sm text-white sm:text-center">© 2023 <a href="/"
                        class="hover:underline">IDPREV</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 space-x-5 sm:justify-center sm:mt-0">

                </div>
            </div>
        </div>
    </footer>
    <!-- AND FOOTER -->


</body>

</html>
