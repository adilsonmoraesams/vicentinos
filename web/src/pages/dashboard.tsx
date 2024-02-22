import { useSession } from "next-auth/react"

export default function Dashboard() {
    const { data: session } = useSession()
    return <h1>Pagina Protegida</h1>
  }
  
  Dashboard.auth = true