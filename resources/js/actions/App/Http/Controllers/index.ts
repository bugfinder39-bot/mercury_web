import PublicController from './PublicController'
import Admin from './Admin'
import Settings from './Settings'
const Controllers = {
    PublicController: Object.assign(PublicController, PublicController),
Admin: Object.assign(Admin, Admin),
Settings: Object.assign(Settings, Settings),
}

export default Controllers