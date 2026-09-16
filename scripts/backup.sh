#!/bin/bash

PROJECT_DIR="/media/rapidtan"
TMP_BACKUP_DIR="$PROJECT_DIR/database/tmp_backups" 
LOG_FILE="$PROJECT_DIR/storage/logs/backup.log"
# -----------------------------
DB_NAME="rapidtanzania_db"
DB_USER="rapidtanzania_user"
DB_PASS="Rapid2025@db"
FTP_HOST="194.163.146.126"
FTP_USER="rapidtan"
FTP_PASS="malonja@2020"
REMOTE_DIR="backups" 
DATE=$(date +"%Y-%m-%d_%H-%M-%S")
BACKUP_FILE="backup_$DATE.tar.gz"
DB_BACKUP_FILE="db_backup_$DATE.sql"




mkdir -p "$(dirname "$LOG_FILE")"
echo "--- Backup Script Started at $(date) ---" > "$LOG_FILE"
echo "Log file: $LOG_FILE"

(
echo "INFO: Project Directory set to: $PROJECT_DIR"

echo "INFO: Creating temporary backup folder: $TMP_BACKUP_DIR"
mkdir -p "$TMP_BACKUP_DIR"
if [ $? -ne 0 ]; then
echo "ERROR: Failed to create temporary backup directory. Check permissions for $PROJECT_DIR."
exit 1
fi

echo "INFO: Starting database dump..."
mysqldump -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" > "$TMP_BACKUP_DIR/$DB_BACKUP_FILE"
if [ $? -ne 0 ]; then
echo "ERROR: Database dump failed. Check credentials, database name, or mysqldump path."
exit 1
fi
echo "SUCCESS: Database dump completed: $DB_BACKUP_FILE"

echo "INFO: Creating project archive (excluding temp files)..."
CURRENT_DIR=$(pwd)
cd "$PROJECT_DIR"

tar --exclude="./database/tmp_backups" -czf "$TMP_BACKUP_DIR/$BACKUP_FILE" .
cd "$CURRENT_DIR"

if [ $? -ne 0 ]; then
echo "ERROR: Project archiving failed. Check the exclusion path in the tar command."
exit 1
fi
echo "SUCCESS: Project archive created: $BACKUP_FILE"


echo "INFO: Starting LFTP upload to $FTP_HOST to remote directory /$REMOTE_DIR"

lftp -e "set ssl:verify-certificate no;
  set cmd:parallel 5;
  open -u $FTP_USER,$FTP_PASS $FTP_HOST;
  # CORRECTED PATH: Use $REMOTE_DIR (which is 'backups') relative to the FTP root (/)
  mkdir -p $REMOTE_DIR;
  cd $REMOTE_DIR;
  put "$TMP_BACKUP_DIR/$DB_BACKUP_FILE";
  put "$TMP_BACKUP_DIR/$BACKUP_FILE";
  bye"

if [ $? -ne 0 ]; then
echo "ERROR: FTP upload failed. Check LFTP installation, FTP credentials, or network connection."
exit 1
fi
echo "SUCCESS: Files uploaded successfully."

echo "INFO: Cleaning up local temp backups older than 7 days..."
find "$TMP_BACKUP_DIR" -type f -mtime +7 -exec rm {} \;
echo "SUCCESS: Cleanup finished."

) 2>&1 | tee -a "$LOG_FILE"

echo "--- Backup Script Finished at $(date) ---" | tee -a "$LOG_FILE"