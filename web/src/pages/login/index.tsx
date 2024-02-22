import { GetServerSideProps } from "next";
import { getSession } from "next-auth/react";
import { useRouter } from "next/router";
import { useContext } from 'react';
import { Button, Container } from "react-bootstrap";
import { useForm } from 'react-hook-form';
import { FaLock } from "react-icons/fa";
import { AuthContext } from '../provider';



export default function Login() {


    const router = useRouter();

    const { register, handleSubmit } = useForm();
    const { signIn } = useContext(AuthContext)

    async function handleSignIn(data: any) {
        console.log(data);
        await signIn(data)
    }

    const { register, handleSubmit } = useForm();
    const { signIn } = useContext(AuthContext)

    async function handleSignIn(data) {
        await signIn(data)
    }



    //     const handleLogin = async () => {
    //         // e.preventDefault();

    //         // const data: ILoginType = {
    //         //     email: username,
    //         //     senha: password
    //         // };

    //         AuthService.login(data)
    //             .then((response: any) => {
    //                 console.log(response.data);
    //             })
    //             .catch((e: Error) => {
    //                 console.log(e);
    //             });


    //         // router.push("/");

    //         /*

    //         if (!username) setErrorMessage('Por favor, informe seu usuário.');

    //         if (!password) setErrorMessage('Por favor, informe sua senha.');

    //         // Chama a função de autenticação do NextAuth
    //         const result = await signIn('credentials', {
    //             redirect: false,
    //             username,
    //             password,
    //         });
    // */
    //         // if (result.error) {
    //         //     console.error('Erro ao autenticar:', result.error);
    //         // } else {
    //         //     console.log('Usuário autenticado:', result);
    //         //     // Redireciona para a página desejada após o login bem-sucedido
    //         //     // Por padrão, o NextAuth redireciona para a página anteriormente acessada pelo usuário
    //         //     window.location.href = '/dashboard';
    //         // }
    //     };

    // const handleSignIn: SubmitHandler<SignInFormData> = async (values) => {
    //     const res = await signIn("credentials", {
    //         redirect: false,
    //         email: values.email,
    //         password: values.password,
    //         callbackUrl: `${window.location.origin}`,
    //     });

    //     if (res.error) {
    //         // toast({
    //         //     title: `${res.error}`,
    //         //     status: "error",
    //         //     duration: 4000,
    //         //     isClosable: true,
    //         // });
    //     }

    //     if (res.url) Router.push(res.url);
    // };


    return (
        <Container fluid className="vh-100">
            <div className="row d-flex justify-content-center align-items-center h-100">
                <div className="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" className="img-fluid" alt="Sample image" />
                </div>
                <div className="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form className="mt-8 space-y-6" onSubmit={handleSubmit(handleSignIn)}>
                        <div className="d-flex flex-row align-items-center justify-content-center">
                            <FaLock size="50" />
                        </div>

                        <p className="text-primary p-3"></p>

                        {/* {errorMessage &&
                            <Alert key="alert-login" variant="danger">
                                <span>{errorMessage}</span>
                            </Alert>} */}

                        {/* <!-- Email input --> */}
                        <div className="form-outline mb-4">
                            {/* <input type="email" id="form3Example3"
                                className="form-control form-control-lg"
                                value={username}
                                onChange={(e) => setUsername(e.target.value)}
                                placeholder="Enter a valid email address" />
                            <label className="form-label" >Email address</label> */}

                            <input
                                {...register('email')}
                                id="email-address"
                                name="email"
                                type="email"
                                autoComplete="email"
                                required
                                placeholder="Email address"
                            />
                        </div>

                        {/* <!-- Password input --> */}
                        <div className="form-outline mb-3">
                            {/* <input type="password"
                                value={password}
                                onChange={(e) => setPassword(e.target.value)}
                                className="form-control form-control-lg"
                                placeholder="Enter password" />
                            <label className="form-label" >Password</label> */}
                            <input
                                {...register('senha')}
                                id="senha"
                                name="senha"
                                type="password"
                                autoComplete="current-password"
                                required
                                placeholder="Digite sua senha"
                            />
                        </div>

                        <div className="d-flex justify-content-between align-items-center">
                            {/* <!-- Checkbox --> */}
                            <div className="form-check mb-0">
                                <input className="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label className="form-check-label" >
                                    Lembrar-me
                                </label>
                            </div>
                            <a href="#!" className="text-body">Esqueci minha senha.</a>
                        </div>

                        <div className="text-center text-lg-start mt-4 pt-2">
                            <Button type="submit" className="btn btn-primary btn-lg"
                                style={{ paddingLeft: '2.5rem', paddingRight: '2.5rem' }}>Login
                            </Button>
                        </div>

                    </form>
                </div>
            </div>

            {/* <div className="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
                <div className="text-white mb-3 mb-md-0">
                    Copyright © 2020. All rights reserved.
                </div>
            </div> */}



        </Container>
    );
}



export const getServerSideProps: GetServerSideProps = async ({ req }) => {
    const session = await getSession({ req });
    // console.log(session);

    if (!session?.user) {
        // Se nao tem usuario vamos redirecionar para  /
        return {
            redirect: {
                destination: "/login",
                permanent: false,
            },
        };
    }

    return {
        props: {},
    };
};