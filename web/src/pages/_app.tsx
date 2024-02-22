import "../styles/globals.css";

// Importing the Bootstrap CSS
import 'bootstrap/dist/css/bootstrap.min.css';
import { SessionProvider } from "next-auth/react";
import { AppProps } from "next/app";
import { ThemeProvider } from "react-bootstrap";

// export default function App({ 
//   Component, 
//   pageProps: { session, ...pageProps },
//  }: AppProps) {
//   return (
//     // <SessionProvider session={session}>
//       <ThemeProvider dir="rtl">
//         <Component {...pageProps} />
//       </ThemeProvider>
//     // </SessionProvider>
//   );
// }


export default function App({
  Component,
  pageProps: { session, ...pageProps },
}: AppProps) {
  return (
    <SessionProvider session={session}>
      <ThemeProvider dir="rtl">
        <Component {...pageProps} />
      </ThemeProvider>
    </SessionProvider>
  );
}