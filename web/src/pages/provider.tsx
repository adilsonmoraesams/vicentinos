import { api } from "@/services/api";
import authService from '@/services/auth.service';
import ILoginType from '@/types/login.type';
import IUsuarioType from "@/types/usuario.type";
import { jwtDecode } from "jwt-decode";
import router from 'next/router';
import { parseCookies, setCookie } from 'nookies';
import { createContext, useEffect, useState } from "react";

type AuthContextType = {
  isAuthenticated: boolean;
  user: IUsuarioType;
  signIn: (data: ILoginType) => Promise<void>
}

export const AuthContext = createContext({} as AuthContextType)


export function AuthProvider({ children }: { children: React.ReactNode }) {
  const [user, setUser] = useState<IUsuarioType | null>(null);
  const isAuthenticated = !!user;

  useEffect(() => {
    const { 'nextauth.token': token } = parseCookies();

    if (token) {
      recuperarInformacaoUsuario(token).then(response => {
        setUser(response)
      })
    }
  }, []);
  
  // Deodifica informações do token
  async function recuperarInformacaoUsuario(token: string)  {
    const decoded = jwtDecode<IUsuarioType>(token);
    return decoded; 
  }

  // Executa chamada na api e grava na session do NextAuth
  async function signIn({ email, senha }: ILoginType) {

    const data: ILoginType = {
      email,
      senha
    };

    authService.login(data)
      .then((response: any) => {

        if (response.data) 
        {
          const token = response.data;
          setCookie(undefined, 'nextauth.token', token, {
            maxAge: 60 * 60 * 1, // 1 hour
          });

          api.defaults.headers['Authorization'] = `Bearer ${token}`;

          setUser(user);

          router.push('/');

        }
      })
      .catch((e: Error) => {
        console.log(e);
      });


  }

  return (
    
    <AuthContext.Provider value={{ user, isAuthenticated, signIn }}>
      {children}
    </AuthContext.Provider>
  )
}