
import axios from "axios";

export default axios.create({
  baseURL: "http://localhost:80/server",
  headers: {
    "Content-type": "application/json"
  }
});
