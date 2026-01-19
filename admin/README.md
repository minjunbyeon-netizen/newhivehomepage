# Admin System Setup Guide

## Access URLs

- **Login Page**: `http://localhost/01_work/hivemedia_homepage/admin/login.html`
- **Dashboard**: `http://localhost/01_work/hivemedia_homepage/admin/dashboard.html`

## User Roles

### Admin
- Full access to all features
- Portfolio writing
- Archive writing
- Migration tools
- Content approval/review

### Staff
- Limited access
- Portfolio writing only
- Archive writing only
- Content goes to pending status

## Firebase Setup Required

### 1. Create User Accounts

In Firebase Console, create users in Authentication:

```
Admin example:
- Email: admin@hivemedia.com
- Password: (your choice)

Staff example:
- Email: staff@hivemedia.com
- Password: (your choice)
```

### 2. Add User Role Documents

In Firestore, create documents in the `users` collection:

```
users/{admin-user-uid}
{
  email: "admin@hivemedia.com",
  role: "admin",
  displayName: "Admin User",
  createdAt: (timestamp)
}

users/{staff-user-uid}
{
  email: "staff@hivemedia.com",
  role: "staff",
  displayName: "Staff User",
  createdAt: (timestamp)
}
```

### 3. Firebase Storage Rules

Update Storage rules to allow authenticated uploads:

```
rules_version = '2';
service firebase.storage {
  match /b/{bucket}/o {
    match /portfolios/{allPaths=**} {
      allow read: if true;
      allow write: if request.auth != null;
    }
    match /archives/{allPaths=**} {
      allow read: if true;
      allow write: if request.auth != null;
    }
  }
}
```

### 4. Firestore Security Rules

```
rules_version = '2';
service cloud.firestore {
  match /databases/{database}/documents {
    
    // Users collection - readable by authenticated, writable by admins
    match /users/{userId} {
      allow read: if request.auth != null;
      allow write: if get(/databases/$(database)/documents/users/$(request.auth.uid)).data.role == 'admin';
    }
    
    // Portfolios - readable by all, writable by authenticated
    match /portfolios/{portfolioId} {
      allow read: if true;
      allow create: if request.auth != null && request.resource.data.status == 'pending';
      allow update: if request.auth != null && 
                       (get(/databases/$(database)/documents/users/$(request.auth.uid)).data.role == 'admin' ||
                        resource.data.createdBy == request.auth.uid);
      allow delete: if get(/databases/$(database)/documents/users/$(request.auth.uid)).data.role == 'admin';
    }
    
    // Archives - readable by all, writable by authenticated
    match /archives/{archiveId} {
      allow read: if true;
      allow create: if request.auth != null && request.resource.data.status == 'pending';
      allow update: if request.auth != null && 
                       (get(/databases/$(database)/documents/users/$(request.auth.uid)).data.role == 'admin' ||
                        resource.data.createdBy == request.auth.uid);
      allow delete: if get(/databases/$(database)/documents/users/$(request.auth.uid)).data.role == 'admin';
    }
  }
}
```

## Workflow

### Staff Workflow
1. Login at `/admin/login.html`
2. Access dashboard
3. Write portfolio or archive content
4. Submit (status: pending)
5. Wait for admin approval

### Admin Workflow
1. Login at `/admin/login.html`
2. Access dashboard
3. Options:
   - Write content (auto-approved)
   - Review pending content in Approval page
   - Run migration tools
   - Approve or reject staff submissions

## Testing

1. Create both admin and staff accounts in Firebase
2. Test staff access (should only see 2 cards)
3. Test admin access (should see all 4 cards)
4. Submit content as staff (should be pending)
5. Approve content as admin
6. Verify approved content appears on public site

## Public Display

Update public portfolio and archive pages to only show approved content:

```javascript
const q = query(
  collection(db, 'portfolios'),
  where('status', '==', 'approved')
);
```
