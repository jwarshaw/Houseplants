import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import Header from './Header'
import HouseplantsIndex from './HouseplantsIndex'
import HouseplantCreate from './HouseplantCreate'
import HouseplantShow from './HouseplantShow'

class App extends Component {
    render() {
        return (
            <BrowserRouter>
                <div>
                    <Header />
                    <Switch>
                        <Route exact path='/' component={HouseplantsIndex} />
                        <Route path='/create' component={HouseplantCreate} />
                        <Route path='/:id' component={HouseplantShow} />
                    </Switch>
                </div>
            </BrowserRouter>
        )
    }
}

ReactDOM.render(<App />, document.getElementById('app'))
