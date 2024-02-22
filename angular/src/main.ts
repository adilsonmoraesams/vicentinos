import { platformBrowserDynamic } from '@angular/platform-browser-dynamic';

import axios from 'axios';
import { AppModule } from './app/app.module';
import { environment } from './environments/environment.development';


axios.defaults.baseURL = environment.apiUrl

axios.interceptors.request.use(function (config) {
  config.headers['X-Binarybox-Api-Key'] = environment.apiKey
  return config;
});

platformBrowserDynamic().bootstrapModule(AppModule)
  .catch(err => console.error(err));
