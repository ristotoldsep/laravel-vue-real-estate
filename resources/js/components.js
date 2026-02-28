import { prime } from './prime'

export default {
  install(app) {
    const components = import.meta.glob('./Components/**/*.vue', {
      eager: true
    })

    for (const [name, component] of Object.entries(prime)) {
      app.component(name, component)
    }

    Object.entries(components).forEach(([path, m]) => {
      const name = path.split('/').pop().split('.')[0]

      if (app.component(name)) return // skip if already registered (e.g. PrimeVue)

      app.component(
        name, m.default
      );
    })
  }
};
