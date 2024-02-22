import ILoginType from "@/types/login.type";
import { api } from "./api";

class AuthService {

//   getAll() {
//     return http.get<Array<IUsuarioType>>("/auth/login");
//   }

//   get(id: string) {
//     return http.get<ITutorialData>(`/tutorials/${id}`);
//   }

  login(data: ILoginType) {
    return api.post<ILoginType>("/auth/login", data);
  }

  /*
  update(data: ITutorialData, id: any) {
    return http.put<any>(`/tutorials/${id}`, data);
  }

  delete(id: any) {
    return http.delete<any>(`/tutorials/${id}`);
  }

  deleteAll() {
    return http.delete<any>(`/tutorials`);
  }

  findByTitle(title: string) {
    return http.get<Array<ITutorialData>>(`/tutorials?title=${title}`);
  }
  */
}

export default new AuthService();
