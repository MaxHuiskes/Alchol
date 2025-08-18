# Cocktail Recipe Application - Site Map

## Main Navigation Structure

### 1. **Cocktails Section**
- **Cocktail Finder** (`/cocktails`)
  - **URL**: `/cocktails`
  - **Purpose**: Select available ingredients to find cocktails you can make
  - **Features**: 
    - Ingredient selection form
    - Results categorized by:
      - Cocktails you can make
      - Cocktails missing 1 ingredient
      - Cocktails containing some ingredients

- **Cocktail List** (`/cocktails/list`)
  - **URL**: `/cocktails/list`
  - **Purpose**: Browse all available cocktails
  - **Features**: Grid layout of all cocktails

- **Cocktail Details** (`/cocktails/{id}`)
  - **URL**: `/cocktails/{id}`
  - **Purpose**: View individual cocktail recipe
  - **Features**:
    - Ingredients list
    - Instructions
    - Back navigation

### 2. **Recipe Management** (Authenticated Users)
- **Recipe Index** (`/recept`)
  - **URL**: `/recept`
  - **Purpose**: Manage cocktail recipes
  - **Features**: List, view, edit, delete recipes

- **New Recipe** (`/recept/new`)
  - **URL**: `/recept/new`
  - **Purpose**: Add new cocktail recipe
  - **Features**: Form with ingredients and instructions

- **Edit Recipe** (`/recept/{id}/edit`)
  - **URL**: `/recept/{id}/edit`
  - **Purpose**: Modify existing recipe

- **Delete Recipe** (`/recept/{id}/delete`)
  - **URL**: `/recept/{id}/delete`
  - **Purpose**: Remove recipe (with confirmation)

### 3. **Ingredient Management** (Authenticated Users)
- **Ingredients Index** (`/alcohol`)
  - **URL**: `/alcohol`
  - **Purpose**: Manage available ingredients
  - **Features**: List, view, edit, delete ingredients

- **New Ingredient** (`/alcohol/new`)
  - **URL**: `/alcohol/new`
  - **Purpose**: Add new ingredient

- **Edit Ingredient** (`/alcohol/{id}/edit`)
  - **URL**: `/alcohol/{id}/edit`
  - **Purpose**: Modify existing ingredient

- **Delete Ingredient** (`/alcohol/{id}/delete`)
  - **URL**: `/alcohol/{id}/delete`
  - **Purpose**: Remove ingredient

### 4. **Authentication**
- **Login** (`/login`)
  - **URL**: `/login`
  - **Purpose**: User authentication
  - **Features**: Login form

- **Logout** (`/logout`)
  - **URL**: `/logout`
  - **Purpose**: User logout

## Page Relationships

```
Home (Cocktail Finder)
├── Cocktails
│   ├── Cocktail List
│   └── Cocktail Details (/{id})
├── Recipe Management (Auth Required)
│   ├── Recipe Index
│   ├── New Recipe
│   ├── Edit Recipe (/{id}/edit)
│   └── Delete Recipe (/{id}/delete)
├── Ingredient Management (Auth Required)
│   ├── Ingredients Index
│   ├── New Ingredient
│   ├── Edit Ingredient (/{id}/edit)
│   └── Delete Ingredient (/{id}/delete)
└── Authentication
    ├── Login
    └── Logout
```

## User Flow

### **Public Users**
1. Visit `/cocktails` to find cocktails by available ingredients
2. Browse `/cocktails/list` to see all cocktails
3. View individual cocktail details at `/cocktails/{id}`

### **Authenticated Users**
1. Access all public features
2. Manage recipes at `/recept`
3. Manage ingredients at `/alcohol`
4. Create new recipes and ingredients

## URL Patterns

| Page Type | URL Pattern | HTTP Method | Purpose |
|-----------|-------------|-------------|---------|
| Cocktail Finder | `/cocktails` | GET | Find cocktails by ingredients |
| Cocktail List | `/cocktails/list` | GET | Browse all cocktails |
| Cocktail Details | `/cocktails/{id}` | GET | View specific cocktail |
| Recipe Index | `/recept` | GET | List all recipes |
| New Recipe | `/recept/new` | GET/POST | Create new recipe |
| Edit Recipe | `/recept/{id}/edit` | GET/POST | Update recipe |
| Delete Recipe | `/recept/{id}` | DELETE | Remove recipe |
| Ingredient Index | `/alcohol` | GET | List all ingredients |
| New Ingredient | `/alcohol/new` | GET/POST | Create new ingredient |
| Edit Ingredient | `/alcohol/{id}/edit` | GET/POST | Update ingredient |
| Delete Ingredient | `/alcohol/{id}` | DELETE | Remove ingredient |
| Login | `/login` | GET/POST | User authentication |
| Logout | `/logout` | GET | User logout |

## Color Scheme Applied
- **Background**: Cream (#FFF8F0)
- **Primary**: Deep Amber (#D97706)
- **Secondary/Accents**: Gold (#FFD700)
- **Text**: Dark Brown (#4B2E2E)
