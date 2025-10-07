import { type IAbstractPlugin } from '@pimcore/studio-ui-bundle'
import { PersonalizationModule } from './modules/personalization'

if (module.hot !== undefined) {
  module.hot.accept()
}

export const PersonalizationPlugin: IAbstractPlugin = {
  name: 'pimcore-personalization-plugin',

  // Register and overwrite services here
  onInit: ({ container }): void => {

  },

  // register modules here
  onStartup: ({ moduleSystem }): void => {
    moduleSystem.registerModule(PersonalizationModule)
    console.log('Hello from personalization.')
  }
}
